<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class MygistsController extends Controller
{
    public function actionMygists(){
        $user_roles = ["admin","user"];
        $user = ["user_name"=>"Admin"];
        $gists = (new User())->gists();
        $categories = ["JS","PHP","Python"];
        return view("mygists",[
            "user"=>$user,
            "user_roles"=>$user_roles,
            "gists"=>$gists,
            "categories"=>$categories
        ]);
    }

    public function actionShowgist($gistid){
        $user_roles = ["admin","user"];
        $user = ["user_name"=>"Admin"];
        $gist_id = $gistid;
        $files = ["file1_".$gist_id,"file2_".$gist_id,"file3_".$gist_id];
        return view("mygist",[
            "user_roles"=>$user_roles,
            "gist_id"=>$gist_id,
            "user"=>$user,
            "files"=>$files]);
    }

    public function actionAddgist(){
        return redirect()->route("mygists");
    }

    public function actionDelgist(){
        return redirect()->route("mygists");
    }
}
