<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 03.04.2019
 * Time: 15:58
 */

namespace App\Services;


use App\Contracts\FileService;
use App\Models\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class DBFileService implements FileService
{
    public function getFile($fileid){
        return DB::table('files')->where('id',$fileid)->first();
    }
    public function addFile(array $data){
        File::create($data);
        (new Request())::session()->flash('message','File: "'.$data["name"].'" added to gist');
    }
    public function delFile($file_id){
        $file = File::where("id",$file_id)->first();
        $file_name = $file->name;
        $file->delete();
        (new Request())::session()->flash('message','File: "'.$file_name.'" deleted from gist');
    }
}
