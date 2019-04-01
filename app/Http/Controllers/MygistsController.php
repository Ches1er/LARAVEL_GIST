<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MygistsController extends Controller
{
    public function actionMygists(){
        $user_id = 1;
        $user_roles = ["admin","user"];
        $user = ["user_name"=>"Admin"];
        $gists = DB::table('gists')->where("user_id",(int)$user_id)->get();
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

    public function actionAddgist(Request $request){
        DB::table('gists')->insert(["user_id"=>1,"category_id"=>1,"desc"=>"cdcdscsd","name"=>$request->post("gist_name")]);
        return redirect()->route("mygists");
    }

    public function actionDelgist($gistid){
        DB::table('gists')->where("id",$gistid)->delete();
        return redirect()->route("mygists");
    }
}
