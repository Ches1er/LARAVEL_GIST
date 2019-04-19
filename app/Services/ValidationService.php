<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 19.04.2019
 * Time: 12:03
 */

namespace App\Services;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidationService
{
    public function GistValidate(Request $request){
        $validator=Validator::make($request->all(),[
            'gist_desc'=>'required|min:3',
            'gist_name'=>'required|min:3',
        ]);
        if ($validator->fails()){
            return $validator->errors();
        }
        else return true;
    }
}
