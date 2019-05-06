<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 18.04.2019
 * Time: 16:26
 */

namespace App\Contracts;


interface MainService
{
    public function getFilesCount();
    public function getGists($category_url,$request);
    public function getUserGists($category_url,$user_id);
    public function getCategories();
    public function getRoles();

}
