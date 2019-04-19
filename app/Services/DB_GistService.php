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

class DB_GistService implements GistService
{
    public function getGist($gist_id){
        return DB::table("gists")->where("id",(int)$gist_id)->first();
    }
    public function getFiles($gist_id){
        return DB::table("files")->where("gist_id",(int)$gist_id)->get();
    }
    public function addGist(array $data){
        DB::transaction(function() use ($data){
            DB::table('gists')->insert($data);
        });

    }
    public function delGist($gistid){
        DB::transaction(function() use ($gistid){
            DB::table('gists')->where("id",$gistid)->delete();
        });
    }
}
