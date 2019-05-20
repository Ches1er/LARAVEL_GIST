<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileValidation;
use App\Mail\EmailConfirmation;
use App\Mail\MailConfigs;
use App\Models\User_token;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

    public function actionRepeatVerificationMail(){

        MailConfigs::instance()->verificationEmail();

        $user_data = ['name' => Auth::user()->name,'remember_token'=>Auth::user()->remember_token];
        Mail::to(Auth::user()->email)->send(new EmailConfirmation($user_data));
        return redirect()->route('main');
    }

    public function actionGetToken(){
        $roles = '["'.implode('","',Auth::user()->roles()).'"]';
        //$token = Crypt::encryptString('{"name":"'.Auth::user()->name.'","role":'.$roles.'}');
        $token = '{"name":"'.Auth::user()->name.'","role":'.$roles.'}';
        User_token::updateOrCreate(['user_id'=>Auth::id()],['token'=>$token]);

        Cookie::queue(Cookie::make('token', $token, 30));

        return redirect()->back();
    }
}
