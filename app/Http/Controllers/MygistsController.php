<?php

namespace App\Http\Controllers;

use App\Services\MainService;
use App\Services\GistService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MygistsController extends Controller
{
    public function actionMygists(Request $request,$caturl="all"){
        $request->get("page")===NULL?$page=1:$page=(int)$request->get("page");
        $user_roles=MainService::instance()->getRoles();
        $categories = MainService::instance()->getCategories();
        $gists = MainService::instance()->getUserGists($caturl,$page,Auth::id());
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
            "gist"=>$gist_content[0],
            "files"=>$files]);
    }

    public function actionAddgist(Request $request){
        $date = time();
        $data = ["user_id"=>1,
                    "category_id"=>$request->post("category_name"),
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
