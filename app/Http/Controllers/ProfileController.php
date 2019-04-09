<?php

namespace App\Http\Controllers;

use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function actionAddpic()
    {
        $uploaddir = 'img/';
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        $user_id = Auth::user()->id;
        ProfileService::addPicProcess($user_id,$uploadfile);
        return redirect()->back();
    }

    public function actionChangename(Request $request){
        $user_id = Auth::user()->id;
        $new_name = $request->post("name");
        ProfileService::changeName($user_id,$new_name);
        return redirect()->back();
    }
}
