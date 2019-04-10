<?php

namespace App\Http\Controllers;

use App\Models\Upic;
use App\Services\AdminService;
use App\Services\MainService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function actionIndex(Request $request,$caturl="all"){
        $request->get("page")===NULL?$page=1:$page=(int)$request->get("page");
        $user_roles=MainService::instance()->getRoles();
        $categories = MainService::instance()->getCategories();
        $gists = MainService::instance()->getGists($caturl,$page);
        $files_count = MainService::instance()->getFilesCount();
        return view("main",["user_roles"=>$user_roles,
            "categories"=>$categories,
            "gists"=>$gists,
            "files_count"=>$files_count]
            );
    }

    public function actionProfile(){
        $user_roles=MainService::instance()->getRoles();
        $upic_id = User::select("upic_id")->where("id",Auth::user()->id)->first();
        $upic_path = Upic::select("path")->where("id",$upic_id->upic_id)->first();
        return view("profile",["upic_path"=>$upic_path,"user_roles"=>$user_roles]);
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
    public function actionAdmin(Request $request){
        is_null($request->get("name"))?$found_user=null:
            $found_user=AdminService::instance()->FindUser($request->get("name"));
        $user_roles=MainService::instance()->getRoles();
        $categories = MainService::instance()->getCategories();
        return view("admin",["user_roles"=>$user_roles,
            "categories"=>$categories,
            "found_user"=>$found_user]
        );
    }

}


