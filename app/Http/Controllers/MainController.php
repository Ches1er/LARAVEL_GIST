<?php

namespace App\Http\Controllers;

use App\Services\MainService;
use App\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function actionIndex(Request $request,$caturl="all"){
        $request->get("page")===NULL?$page=1:$page=(int)$request->get("page");
        $user_roles = ["admin","user"];
        $user = ["user_name"=>"Admin"];
        $categories = MainService::instance()->getCategories();
        $gists = MainService::instance()->getGists($caturl,$page);
        $files_count = MainService::instance()->getFilesCount();
        return view("main",["user_roles"=>$user_roles,
            "user"=>$user,
            "categories"=>$categories,
            "gists"=>$gists,
            "files_count"=>$files_count]
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

    }

    public function actionLogout(){

    }
    public function actionAdmin(){

    }

}


