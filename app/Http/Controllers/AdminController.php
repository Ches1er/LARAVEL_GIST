<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\AdminService;
use App\Contracts\CategoryService;

class AdminController extends Controller
{
    protected $adminservice;
    protected $categoryservice;

    /**
     * AdminController constructor.
     * @param AdminService $adminService
     */
    public function __construct(AdminService $adminService,CategoryService $categoryService)
    {
        $this->adminservice = $adminService;
        $this->categoryservice =$categoryService;
    }


    public function actionAddnewcat(Request $request){
        $this->categoryservice->AddCategory($request->post("name"));
        return redirect()->route("admin");
    }

    public function actionBanUser(Request $request){
        $this->adminservice->BanUser($request->post("id"));
        return redirect()->route("admin");
    }

    public function actionUnbanUser(Request $request){
        $this->adminservice->UnbanUser($request->post("id"));
        return redirect()->route("admin");
    }

    public function actionVerifyUserEmail(Request $request){
        $this->adminservice->VerifyEmail($request->post("id"));
        return redirect()->route("admin");
    }

    public function actionChangecatname(Request $request){
        $this->adminservice->
            ChangeCategoryName($request->post("cat_name"),
            $request->post("new_cat_name"));

        return redirect()->route("admin");
    }
}
