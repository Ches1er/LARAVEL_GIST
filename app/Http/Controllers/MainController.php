<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\AdminService;
use App\Contracts\MainService;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    protected $mainservice;

    /**
     * MainController constructor.
     * @param $mainservice
     */
    public function __construct(MainService $mainservice)
    {
        $this->mainservice = $mainservice;
    }


    public function actionIndex(Request $request,$caturl="all"){
        return view("main",["user_roles"=>$this->mainservice->getRoles(),
            "categories"=>$this->mainservice->getCategories(),
            "gists"=>$this->mainservice->getGists($caturl),
            "files_count"=>$this->mainservice->getFilesCount()]
            );
    }

    public function actionProfile(){
        return view("profile",["user_roles"=>$this->mainservice->getRoles()]);
    }

    public function actionAdmin(Request $request,AdminService $adminService){
        is_null($request->get("name"))?$found_user=null:
            $found_user=$adminService->FindUser($request->get("name"));
        return view("admin",["user_roles"=>$this->mainservice->getRoles(),
            "categories"=>$this->mainservice->getCategories(),
            "found_user"=>$found_user]
        );
    }
    public function actionLogout(Request $request)
    {
        Auth::guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }
}


