<?php

namespace App\Http\Controllers;

use App\Events\ChangePass;
use App\Http\Requests\ProfileValidation;
use App\Models\Change_password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Contracts\ProfileService;

class ProfileController extends Controller
{
    protected $profileservice;

    /**
     * ProfileController constructor.
     * @param ProfileService $profileService
     */
    public function __construct(ProfileService $profileService)
    {
        $this->profileservice = $profileService;
    }

    public function actionAddpic()
    {
        $uploaddir = 'img/';
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        $this->profileservice->AddPic(Auth::user()->id,$uploadfile);
        return redirect()->back();
    }

    public function actionChangename(ProfileValidation $request){
        $this->profileservice->ChangeName(Auth::user()->id,$request->post("name"));
        return redirect()->back();
    }

    public function actionRepeatVerificationMail(){
        $user_data = ['name' => Auth::user()->name,'verification_token'=>Auth::user()->email_verification_token];
        return $this->profileservice->RepeatVerificationMail($user_data);
    }

    public function actionGetToken(){

        $roles = '["'.implode('","',Auth::user()->roles()).'"]';
        $token = Crypt::encryptString('{"name":"'.Auth::user()->name.'","role":'.$roles.'}');
        //$token = '{"name":"'.Auth::user()->name.'","role":'.$roles.'}';
        return $this->profileservice->GetToken($token);
   }

    public function actionChangePasswordRequest(Request $request){
        $new_password = $request->post('new_password');
        return $this->profileservice->ChangePasswordRequest(Auth::id(),$new_password);
    }

    public function actionChangePasswordAccepted($userid,Request $request){
        return $this->profileservice->ChangePasswordAccepted($userid,$request);
    }
}
