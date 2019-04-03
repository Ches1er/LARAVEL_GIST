<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestController extends Controller
{
    public function actionGists($catid="all"){
        $catid==="all"?$gists=json_encode(DB::table('gists')->get()):
            $gists=json_encode(DB::table('gists')->where("category_id",(int)$catid)->get());
        return $gists;
    }
    public function actionFiles($gistid){
        return json_encode(DB::table('files')->where("gist_id",$gistid)->get());
    }
    public function actionCategories(){
        return json_encode(DB::table('categories')->get());
    }
    public function actionAddCategory(Request $request){
        DB::table('categories')->insert(["name"=>$request->post("category_name")]);
    }
    public function actionDelCategory(Request $request){
        DB::table('categories')->delete(["name"=>$request->post("id")]);
    }
}
