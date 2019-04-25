<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileValidation;
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

    public function actionChangename(ProfileValidation $request){
        ProfileService::changeName(Auth::user()->id,$request->post("name"));
        return redirect()->back();
    }
}
