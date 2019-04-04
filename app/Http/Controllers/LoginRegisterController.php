<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LoginRegisterController extends Controller
{
    public function actionRegister(Request $request){
        $user = new User;
        $user->name = $request->post('name');
        $user->email = $request->post('email');
        $user->password = $request->post('password');
        $user->upic_id = 1;
        $user->save();
        return redirect()->route("main");
    }
}
