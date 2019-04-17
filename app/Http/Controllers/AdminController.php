<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function actionAddnewcat(Request $request){
        CategoryService::instance()->AddCategory($request->post("name"));
        return redirect()->route("admin");
    }

    public function actionBanUser(Request $request){
        AdminService::instance()->BanUser($request->post("id"));
        return redirect()->route("admin");
    }

    public function actionUnbanUser(Request $request){
        AdminService::instance()->UnbanUser($request->post("id"));
        return redirect()->route("admin");
    }

    public function actionChangecatname(Request $request){
        AdminService::instance()->
            ChangeCategoryName($request->post("cat_name"),
            $request->post("new_cat_name"));

        return redirect()->route("admin");
    }
}
