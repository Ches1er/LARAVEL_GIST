<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 08.04.2019
 * Time: 16:40
 */

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ProfileService
{
    public static function addPicProcess($id,$uploadfile){
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            $pic_id=DB::table("upic")->insertGetId(["path"=>$uploadfile]);
            DB::table("users")->where("id",$id)->update(["upic_id"=>$pic_id]);
            return "";
        } else {
            return redirect()->back();
        }
    }

    public static function changeName($id, $new_name):void
    {
        DB::table("users")->where("id",$id)->update(["name"=>$new_name]);
    }

}
