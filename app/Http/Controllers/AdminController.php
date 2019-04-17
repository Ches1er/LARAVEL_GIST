<?php

namespace App\Http\Controllers;


use App\Services\CategoryService;
use Illuminate\Http\Request;

use App\Facades\AdminServiceFacade;

class AdminController extends Controller
{
    public function actionAddnewcat(Request $request){
        CategoryService::instance()->AddCategory($request->post("name"));
        return redirect()->route("admin");
    }

    public function actionBanUser(Request $request){
        AdminServiceFacade::BanUser($request->post("id"));
        return redirect()->route("admin");
    }

    public function actionUnbanUser(Request $request){
        AdminServiceFacade::UnbanUser($request->post("id"));
        return redirect()->route("admin");
    }

    public function actionChangecatname(Request $request){
        AdminServiceFacade::
            ChangeCategoryName($request->post("cat_name"),
            $request->post("new_cat_name"));

        return redirect()->route("admin");
    }
}
