<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 08.04.2019
 * Time: 16:40
 */

namespace App\Services;

use App\Events\ChangePass;
use App\Mail\EmailConfirmation;
use App\Mail\MailConfigs;
use App\Models\Change_password;
use App\Models\User_token;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use App\Contracts\ProfileService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class DBProfileService implements ProfileService
{

    public function ChangeName($id, $new_name):void
    {
        User::where("id",$id)->update(["name"=>$new_name]);
    }

    public function AddPic($user_id, $uploadfile)
    {
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            $pic_id=DB::table("upic")->insertGetId(["path"=>$uploadfile]);
            User::where("id",$user_id)->update(["upic_id"=>$pic_id]);
            return "";
        } else {
            return redirect()->back();
        }
    }

    public function RepeatVerificationMail($user_data)
    {
        MailConfigs::instance()->verificationEmail();

        Mail::to(Auth::user()->email)->send(new EmailConfirmation($user_data));
        return redirect()->route('main');
    }

    public function GetToken($token)
    {
        User_token::updateOrCreate(['user_id'=>Auth::id()],['token'=>$token]);
        Cookie::queue(Cookie::make('token', $token, 30));
        return redirect()->back();
    }

    public function ChangePasswordRequest($user_id, $new_password)
    {
        MailConfigs::instance()->verificationEmail();
        Change_password::updateOrCreate(['user_id'=>$user_id],['is_changed'=>0,'new_password'=>Hash::make($new_password)]);
        event(new ChangePass());
        return redirect()->back();
    }

    public function ChangePasswordAccepted($user_id)
    {

    }

    public function ChangePasswordAborted($user_id)
    {
        // TODO: Implement ChangePasswordAborted() method.
    }
}
