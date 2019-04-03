<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GistController extends Controller
{
    public function actionShowgist($gistid){
        $user_roles = ["admin","user"];
        $user = ["user_name"=>"Admin"];
        $gist_content = DB::table("gists")->where("id",(int)$gistid)->get();
        $files = DB::table("files")->where("gist_id",(int)$gistid)->get();
        return view("gist",[
            "user_roles"=>$user_roles,
            "user"=>$user,
            "gist"=>$gist_content[0],
            "files"=>$files]);
    }
    public function actionShowfile($fileid){
        $user_roles = ["admin","user"];
        $user = ["user_name"=>"Admin"];
        $file = DB::table('files')->where("id",$fileid)->get();
        return view("file",["user_roles"=>$user_roles,
            "user"=>$user,"file"=>$file[0]]);
    }
}
