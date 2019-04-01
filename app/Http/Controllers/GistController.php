<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GistController extends Controller
{
    public function actionShowgist($gistid){
        $user_roles = ["admin","user"];
        $user = ["user_name"=>"Admin"];
        $gist_id = $gistid;
        $files = ["file1_".$gist_id,"file2_".$gist_id,"file3_".$gist_id];
        return view("gist",[
            "user_roles"=>$user_roles,
            "gist_id"=>$gist_id,
            "user"=>$user,
            "files"=>$files]);
    }
    public function actionShowfile($fileid){
        return view("file");
    }
}
