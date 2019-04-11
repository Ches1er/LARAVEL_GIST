<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use App\Services\GistService;
use App\Services\MainService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GistController extends Controller
{

    public function actionShowgist($gistid){
        $user_roles=MainService::instance()->getRoles();
        $gist_content = GistService::instance()->getGist($gistid);
        $files = GistService::instance()->getFiles($gistid);
        return view("gist",[
            "user_roles"=>$user_roles,
            "gist"=>$gist_content,
            "files"=>$files]);
    }
    public function actionShowfile($fileid){
        $user_roles=MainService::instance()->getRoles();
        $file = FileService::instance()->getFile($fileid);
        return view("file",["file"=>$file,"user_roles"=>$user_roles]);
    }
}
