<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 03.04.2019
 * Time: 14:21
 */

namespace App\Services;


use Illuminate\Support\Facades\DB;

class GistService
{
    private static $ins = null;
    const POSTS_PER_PAGE = 5;
    public static function instance()
    {
        return self::$ins === null ? self::$ins = new self() : self::$ins;
    }
    private function __construct()
    {
    }
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
