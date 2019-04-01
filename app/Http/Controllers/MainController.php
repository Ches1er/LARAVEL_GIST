<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Psr\Log\NullLogger;

class MainController extends Controller
{
    public function actionIndex(Request $request){
        $request->get("page")===NULL?$page=1:$page=(int)$request->get("page");
        $user_roles = ["admin","user"];
        $user = ["user_name"=>"Admin"];
        $categories = ["JS","PHP","Python"];
        $gists = (new User())->gists();
        return view("main",["user_roles"=>$user_roles,
            "user"=>$user,
            "categories"=>$categories,
            "gists"=>$gists]
            );
    }

    public function actionProfile(){
        return view("profile",["user_name"=>"username"]);
    }
    public function actionMyGists(){
    $gists = (new User())->gists();
    return view("mygists",["gists"=>$gists
    ]);
    }

    public function actionLogin(){

    }

    public function actionRegister(){

    }

    public function actionLogout(){

    }
    public function actionAdmin(){

    }

}


