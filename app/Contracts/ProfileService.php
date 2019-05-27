<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 21.05.2019
 * Time: 10:25
 */

namespace App\Contracts;


use Illuminate\Http\Request;

interface ProfileService
{
    public function AddPic($user_id,$uploadfile);
    public function ChangeName($user_id,$new_name);
    public function RepeatVerificationMail($user_data);
    public function GetToken($token);
    public function ChangePasswordRequest($user_id,$new_password);
    public function ChangePasswordAccepted($user_id,Request $request);
    public function ChangePasswordAborted($user_id);
}
