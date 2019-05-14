<?php

namespace App\Http\Controllers;

use App\Contracts\MainService;
use App\User;
use Illuminate\Http\Request;
use App\Contracts\AdminService;
use App\Contracts\CategoryService;
use Illuminate\Validation\ValidationException;


class AdminController extends Controller
{
    protected $adminservice;
    protected $categoryservice;
    protected $mainservice;

    /**
     * AdminController constructor.
     * @param MainService $mainservice
     * @param AdminService $adminService
     * @param CategoryService $categoryService
     */
    public function __construct(MainService $mainservice,AdminService $adminService,CategoryService $categoryService)
    {
        $this->adminservice = $adminService;
        $this->categoryservice =$categoryService;
        $this->mainservice = $mainservice;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function actionAddnewcat(Request $request){
            $this->validate($request, [
                'name' => 'required|min:2'
            ], ['name.required'=>'Please add new category name',
                'name.min'=>'New category name has to content at least 2 symbols'
                ]);
        $this->categoryservice->AddCategory($request->post("name"));
        return redirect()->route("admin");
    }

    private function viewWithFoundUser(int $id){
        $found_user = User::where('id',$id)->first();
        return view("admin",["user_roles"=>$this->mainservice->getRoles(),
                "categories"=>$this->mainservice->getCategories(),
                "found_user"=>$found_user]
        );
    }

    public function actionBanUser(Request $request){
        $this->adminservice->BanUser($request->post("id"));
        return $this->viewWithFoundUser($request->post("id"));
    }

    public function actionUnbanUser(Request $request){
        $this->adminservice->UnbanUser($request->post("id"));
        return $this->viewWithFoundUser($request->post("id"));
    }

    public function actionVerifyUserEmail(Request $request){
        $this->adminservice->VerifyEmail($request->post("id"));
        return redirect()->route("admin");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function actionChangecatname(Request $request){
        $this->validate($request, [
            'cat_name' => 'required|min:2',
            'new_cat_name' => 'required|min:2'
        ], ['cat_name.required'=>'Please add category name you want to change',
            'cat_name.min'=>'New category name has to content at least 2 symbols',
            'new_cat_named'=>'Please add new category name',
            'new_cat_name'=>'New category name has to content at least 2 symbols'
        ]);
        $this->adminservice->
            ChangeCategoryName($request->post("cat_name"),
            $request->post("new_cat_name"));

        return redirect()->route("admin");
    }
}
