<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 03.04.2019
 * Time: 15:58
 */

namespace App\Services;


use Illuminate\Support\Facades\DB;

class FileService
{
    private static $ins = null;
    public static function instance()
    {
        return self::$ins === null ? self::$ins = new self() : self::$ins;
    }
    private function __construct()
    {
    }
    public function getFile($fileid){
        return DB::table('files')->where('id',$fileid)->get();
    }
    public function addFile(array $data){
        DB::transaction(function()use ($data){
            DB::table("files")->insert($data);
        });
    }
    public function delFile($file_id){
        DB::table('files')->where("id",$file_id)->delete();
    }
}
