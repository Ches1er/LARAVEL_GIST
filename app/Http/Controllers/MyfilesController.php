<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyfilesController extends Controller
{
    public function actionAddfile(Request $request){
        $gist_id = 1; //$request->post("gistid");
        return redirect()->route("showmygist",["gistid"=>$gist_id]);
    }
    public function actionDelfile(Request $request){
        $gist_id = 1; //$request->post("gistid");
        return redirect()->route("showmygist",["gistid"=>$gist_id]);
    }
    public function actionEditfile($fileid){
        return view("edit_file");
    }
}
