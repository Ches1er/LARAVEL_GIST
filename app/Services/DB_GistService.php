<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 18.04.2019
 * Time: 15:51
 */

namespace App\Services;


use Illuminate\Support\Facades\DB;
use App\Contracts\GistService;
use Illuminate\Support\Facades\Validator;

class DB_GistService implements GistService
{
    public function getGist($gist_id){
        return DB::table("gists")->where("id",(int)$gist_id)->first();
    }
    public function getFiles($gist_id){
        return DB::table("files")->where("gist_id",(int)$gist_id)->get();
    }
    public function addGist(array $data){
        $validator=Validator::make($data,[
            'gist_desc'=>'required|min:3',
            'gist_name'=>'required|min:3',
        ],[
            'gist_desc.required' => 'Gist description is required',
            'gist_name.required' => 'Gist name is required',
            'gist_desc.min' => 'Gist description has to contain at least 3 symbols',
            'gist_name.min' => 'Gist name has to contain at least 3 symbols',
        ]);
        if ($validator->fails()){
            return redirect()->route('mygists')
                ->withErrors($validator)
                ->withInput();
        }
        else {
            DB::transaction(function() use ($data){
                DB::table('gists')->insert($data);

        });
            return redirect()->route('mygists');
        }

    }
    public function delGist($gistid){
        DB::transaction(function() use ($gistid){
            DB::table('gists')->where("id",$gistid)->delete();
        });
    }
}
