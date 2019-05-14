<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 18.04.2019
 * Time: 13:08
 */

namespace App\Contracts;


use Illuminate\Http\Request;

interface FileService
{
    public function getFile($fileid);
    public function addFile(array $data);
    public function delFile($file_id);

}
