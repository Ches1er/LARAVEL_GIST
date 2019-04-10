<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function actionAddnewcat(Request $request){
        AdminService::instance()->AddCategory($request->post("name"));
        return redirect()->route("admin");
    }
}
