<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 18.04.2019
 * Time: 16:07
 */

namespace App\Contracts;


interface GistService
{
    public function getGist($gist_id);
    public function getFiles($gist_id);
    public function addGist(array $data);
    public function delGist($gistid);
}
