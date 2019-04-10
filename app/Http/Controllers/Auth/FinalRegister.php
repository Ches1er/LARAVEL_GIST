<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 10.04.2019
 * Time: 16:20
 */

namespace App\Http\Controllers\Auth;


use Illuminate\Support\Facades\DB;

class FinalRegister
{
    public function actionFinalRegister($token){

        DB::transaction(function () use ($token){
            $time = (string)time();
            $id = DB::table('users')->select(['id'])->where('remember_token',$token)->first();
            DB::table('users')->where('remember_token',$token)->whereNull('email_verified_at')
                ->update(['email_verified_at'=>$time]);
            if(is_null(DB::table('user_roles')->where('user_id',(int)$id->id)->first()))
            {
                DB::table('user_roles')->insert(['user_id'=>$id->id,'role_id'=>2]);
            }
        });
        return redirect()->route('main');
    }

}
