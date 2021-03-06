<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contracts\MainService;
use App\Contracts\CategoryService;
use App\Contracts\GistService;

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
            "user_categories"=>$this->mainservice->getUserCategories(),
            "all_categories"=>$this->mainservice->getCategories(),
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
        $request->post('private')===null?$private='public':$private='private';
        if (is_null($request->post("category_name_new"))){
            $category_id = $request->post("category_name");
        }
        else {
            $category_id = $this->categoryservice->
                    addCategory($request->post("category_name_new"));
        }
            $data = ["user_id"=>Auth::id(),
                "category_id"=>$category_id,
                "desc"=>$request->post("gist_desc"),
                "name"=>$request->post("gist_name"),
                "private"=>$private,
                "date"=>time()];
        return $this->gistservice->addGist($data);
    }

    public function actionDelgist($gistid){
        $this->gistservice->delGist($gistid);
        return redirect()->route("mygists");
    }
}
