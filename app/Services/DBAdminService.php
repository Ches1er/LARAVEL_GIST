<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 09.04.2019
 * Time: 15:18
 */

namespace App\Services;

use App\Models\Category;
use App\Models\Role;
use App\Models\User_role;
use App\User;
use App\Contracts\AdminService;

class DBAdminService implements AdminService
{

    public function FindUser($name){
        return User::where('name','like',$name.'%')->first();
    }

    public function BanUser($id){
        $invalid_user_role = Role::where('name',\Roles_constants::INVALID_USER)
                                        ->first();
        User_role::where('user_id',$id)
                    ->update(['role_id'=>$invalid_user_role->id]);
    }

    public function UnbanUser($id){
        $invalid_user_role = Role::where('name',\Roles_constants::ACTIV_USER)
            ->first();
        User_role::where('user_id',$id)
                    ->update(['role_id'=>$invalid_user_role->id]);
    }

    public function ChangeCategoryName($old_name,$new_name){
        Category::where('name',$old_name)
                    ->update(['name'=>$new_name]);
    }
    public function VerifyEmail($id){
        User::where('id',$id)
                ->update(['email_verified_at'=>time()]);
    }
}
