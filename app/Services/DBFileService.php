<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 03.04.2019
 * Time: 15:58
 */

namespace App\Services;


use App\Contracts\FileService;
use Illuminate\Support\Facades\DB;

class DBFileService implements FileService
{

    public function getFile($fileid){
        return DB::table('files')->where('id',$fileid)->first();
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
