<?php

namespace App\Http\Controllers;

use App\Services\MainService;
use App\Services\GistService;
use Illuminate\Http\Request;

class MygistsController extends Controller
{
    public function actionMygists(Request $request,$caturl="all"){
        $request->get("page")===NULL?$page=1:$page=(int)$request->get("page");
        $user_id = 1;
        $user_roles = ["admin","user"];
        $user = ["user_name"=>"Admin"];
        $categories = MainService::instance()->getCategories();
        $gists = MainService::instance()->getUserGists($caturl,$page,$user_id);
        return view("mygists",[
            "user"=>$user,
            "user_roles"=>$user_roles,
            "gists"=>$gists,
            "categories"=>$categories
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
