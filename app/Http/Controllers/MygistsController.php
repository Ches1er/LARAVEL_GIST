<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Contracts\MainService;
use App\Contracts\CategoryService;
use App\Contracts\GistService;
use App\Facades\Validation;

class MygistsController extends Controller
{

    protected $mainservice;
    protected $categoryservice;
    protected $gistservice;

    /**
     * MygistsController constructor.
     * @param MainService $mainService
     * @param CategoryService $categoryservice
     * @param GistService $gistservice
     */
    public function __construct(MainService $mainService,
                                CategoryService $categoryservice,
                                GistService $gistservice)
    {
        $this->mainservice = $mainService;
        $this->categoryservice = $categoryservice;
        $this->gistservice = $gistservice;
    }


    public function actionMygists(Request $request,$caturl="all"){
        return view("mygists",[
            "user_roles"=>$this->mainservice->getRoles(),
            "gists"=>$this->mainservice->getUserGists($caturl,Auth::id()),
            "categories"=>$this->mainservice->getCategories(),
            "files_count"=>$this->mainservice->getFilesCount()
        ]);
    }

    public function actionShowgist($gistid){
        return view("mygist",[
            "user_roles"=>$this->mainservice->getRoles(),
            "gist"=>$this->gistservice->getGist($gistid),
            "files"=>$this->gistservice->getFiles($gistid)]);
    }

    public function actionAddgist(Request $request){
        if (is_null($request->post("category_name_new"))){
            $category_id = $request->post("category_name");
        }
        else {
            $category_id = $this->categoryservice->
                    addCategory($request->post("category_name_new"));
        }
            $data = ["user_id"=>Auth::id(),
                "category_id"=>$category_id,
                "gist_desc"=>$request->post("gist_desc"),
                "gist_name"=>$request->post("gist_name"),
                "date"=>time()];
        return $this->gistservice->addGist($data);
    }

    public function actionDelgist($gistid){
        $this->gistservice->delGist($gistid);
        return redirect()->route("mygists");
    }
}
