<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 16.04.2019
 * Time: 15:03
 */

namespace App\Services;


use Illuminate\Support\Facades\DB;
use App\Contracts\CategoryService;

class DBCategoryService implements CategoryService
{
    public function addCategory($name){
        return DB::table('categories')->insertGetId(['name'=>$name]);
    }
}
