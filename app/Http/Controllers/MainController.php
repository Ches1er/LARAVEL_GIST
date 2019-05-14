<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotFoundException;
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
        return view("main",[
            "user_roles"=>$this->mainservice->getRoles(),
            "categories"=>$this->mainservice->getCategories(),
            "gists"=>$this->mainservice->getGists($caturl,$request),
            "files_count"=>$this->mainservice->getFilesCount()
            ]);
    }

    public function actionProfile(){
        return view("profile",["user_roles"=>$this->mainservice->getRoles()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function actionAdmin(Request $request){
        $request->session()->forget('find_user_error');
        return view("admin",["user_roles"=>$this->mainservice->getRoles(),
            "categories"=>$this->mainservice->getCategories(),
            "found_user"=>null]
        );
    }

    public function actionAdminFindUser(Request $request, AdminService $adminService){
        $found_user=null;

        if (is_null($request->get("user_name"))){
            session(['find_user_error'=>'User name cant`be empty']);
        }
        else {
            $found_user=$adminService->FindUser($request->get("user_name"));
            $request->session()->forget('find_user_error');
        }
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
/*    public function actionTest(Request $request){
        throw new UserNotFoundException('User '.$request->get('user')." not found");
    }*/
}


