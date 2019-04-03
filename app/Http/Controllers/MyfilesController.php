<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use Illuminate\Http\Request;

class MyfilesController extends Controller
{
    public function actionShowfile($fileid){
        $user_roles = ["admin","user"];
        $user = ["user_name"=>"Admin"];
        $file = FileService::instance()->getFile($fileid);
        return view('myfile',["user_roles"=>$user_roles,
            "user"=>$user,"file"=>$file[0]]);
    }
    public function actionAddfile(Request $request){
        $data = ["gist_id"=>$request->post("gist_id"),
                "name"=>$request->post("file_name"),
                "content"=>$request->post("file_content")];
        FileService::instance()->addFile($data);
        return redirect()->back();
    }
    public function actionDelfile($fileid){
        FileService::instance()->delFile($fileid);
        return redirect()->back();
    }
}
