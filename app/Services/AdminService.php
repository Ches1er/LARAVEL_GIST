<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 09.04.2019
 * Time: 15:18
 */

namespace App\Services;


use App\Models\Category;

use App\User;
use Illuminate\Support\Facades\DB;

class AdminService
{
    private static $ins = null;
    public static function instance()
    {
        return self::$ins === null ? self::$ins = new self() : self::$ins;
    }
    private function __construct()
    {
    }

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
