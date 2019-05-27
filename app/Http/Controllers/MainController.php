<?php

namespace App\Http\Controllers;


use App\Http\Requests\AdminFindUser;
use App\Models\File_exchange;
use Illuminate\Http\Request;
use App\Contracts\AdminService;
use App\Contracts\MainService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
        $error = session('error');
        Session::forget('error');
        return view("profile",["user_roles"=>$this->mainservice->getRoles(),
            'error'=>$error
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function actionAdmin(Request $request){
        return view("admin",["user_roles"=>$this->mainservice->getRoles(),
            "categories"=>$this->mainservice->getCategories(),
            "found_user"=>null]
        );
    }

    public function actionAdminFindUser(AdminFindUser $request, AdminService $adminService){
        $found_user=$adminService->FindUser($request->get("user_name"));
        return view("admin",["user_roles"=>$this->mainservice->getRoles(),
                "categories"=>$this->mainservice->getCategories(),
                "found_user"=>$found_user]
        );
    }

    public function actionLogout(Request $request)
    {
        Auth::guard()->logout();
        $request->session()->invalidate();
        setcookie("token", "", time() - 3600);
        return redirect('/');
    }
/*    public function actionTest(Request $request){
        throw new UserNotFoundException('User '.$request->get('user')." not found");
    }*/

    //File exchange

    public function actionFilesExchange(){
        $files = File_exchange::all();
        return view('files_exchange',['files_exch'=>$files,"user_roles"=>$this->mainservice->getRoles(),"user_id"=>Auth::id()]);
    }

    public function actionFilesExchangeHandle(Request $request){
        $request->post('private')===null?$private='public':$private='private';
        $path = Storage::disk('public')->putFile('',$request->file('file'));
        $filename = basename($request->file('file')->getClientOriginalName());
        $full_path = asset("storage/$path");
        File_exchange::create(['name'=>$filename,'user_id'=>Auth::id(),'private'=>$private,'path'=>$full_path]);
        return redirect()->back();
    }

    public function actionFilesExchangeDownload(Request $request){
        $file = File_exchange::where('id',$request->post('id'))->first();
        return Storage::disk('public')->download($file->path);
    }
}


