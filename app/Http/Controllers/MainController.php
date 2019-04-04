<?php

namespace App\Http\Controllers;

use App\Services\MainService;
use App\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function actionIndex(Request $request,$caturl="all"){
        $request->get("page")===NULL?$page=1:$page=(int)$request->get("page");
        $categories = MainService::instance()->getCategories();
        $gists = MainService::instance()->getGists($caturl,$page);
        return view("main",["user_roles"=>null,
            "user"=>null,
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

    public function actionBack(){
        return redirect()->back();
    }

    public function actionLogin(){

    }

    public function actionRegister(){
        return view("register");
    }

    public function actionLogout(){

    }
    public function actionAdmin(){

    }

}


