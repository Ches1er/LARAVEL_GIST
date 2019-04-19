<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 09.04.2019
 * Time: 15:18
 */

namespace App\Services;

use App\User;
use Illuminate\Support\Facades\DB;
use App\Contracts\AdminService;

class DBAdminService implements AdminService
{

    public function FindUser($name){
        return User::where('name',$name)->first();
    }

    public function BanUser($id){
        DB::table('user_roles')->where('user_id',$id)->
            update(['role_id'=>3]);
    }

    public function UnbanUser($id){

        DB::table('user_roles')->where('user_id',$id)->
            update(['role_id'=>2]);
    }

    public function ChangeCategoryName($old_name,$new_name){
        DB::table('categories')->where('name',$old_name)->
            update(['name'=>$new_name]);
    }
}
