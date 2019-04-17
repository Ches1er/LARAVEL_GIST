<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\MainService;
use App\Services\GistService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MygistsController extends Controller
{
    public function actionMygists(Request $request,$caturl="all"){
        $user_roles=MainService::instance()->getRoles();
        $categories = MainService::instance()->getCategories();
        $gists = MainService::instance()->getUserGists($caturl,Auth::id());
        $files_count = MainService::instance()->getFilesCount();
        return view("mygists",[
            "user_roles"=>$user_roles,
            "gists"=>$gists,
            "categories"=>$categories,
            "files_count"=>$files_count
        ]);
    }

    public function actionShowgist($gistid){
        $user_roles = ["admin","user"];
        $user = ["user_name"=>"Admin"];
        $gist_content = GistService::instance()->getGist($gistid);
        $files = GistService::instance()->getFiles($gistid);
        return view("mygist",[
            "user_roles"=>$user_roles,
            "user"=>$user,
            "gist"=>$gist_content,
            "files"=>$files]);
    }

    public function actionAddgist(Request $request){
        $date = time();

        if (is_null($request->post("category_name_new"))){
            $category_id = $request->post("category_name");
        }
        else {
            $category_id = CategoryService::instance()->
                    addCategory($request->post("category_name_new"));
        }

        $data = ["user_id"=>Auth::id(),
                    "category_id"=>$category_id,
                    "desc"=>$request->post("gist_desc"),
                    "name"=>$request->post("gist_name"),
                    "date"=>$date];
        GistService::instance()->addGist($data);
        return redirect()->route("mygists");
    }

    public function actionDelgist($gistid){
        GistService::instance()->delGist($gistid);
        return redirect()->route("mygists");
    }
}
