<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 16.04.2019
 * Time: 15:03
 */

namespace App\Services;


use Illuminate\Support\Facades\DB;

class CategoryService
{
    private static $ins = null;
    public static function instance()
    {
        return self::$ins === null ? self::$ins = new self() : self::$ins;
    }
    private function __construct()
    {
    }

    public function addCategory($name){
        return DB::table('categories')->insertGetId(['name'=>$name]);
    }
}
