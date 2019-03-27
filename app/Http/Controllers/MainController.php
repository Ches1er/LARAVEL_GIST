<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function actionIndex(){
        return view("main");
    }

    public function actionProfile(){
        return view("profile",["user_name"=>"username"]);
    }
    public function actionMyGists(){
    return view("mygists",[
        ["gist_name"=>"gist1_name","files"=>["file1_1","file1_2"]],
        ["gist_name"=>"gist2_name","files"=>["file2_1","file2_2"]],
        ["gist_name"=>"gist3_name","files"=>["file3_1","file3_2"]]
    ]);
}
}


