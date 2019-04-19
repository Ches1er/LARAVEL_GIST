<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 09.04.2019
 * Time: 15:18
 */

namespace App\Services;


use App\Models\Category;

use App\User;
use Illuminate\Support\Facades\DB;

class AdminService
{
    private static $ins = null;
    public static function instance()
    {
        return self::$ins === null ? self::$ins = new self() : self::$ins;
    }
    private function __construct()
    {
    }

    public function AddCategory($name){
        Category::create(["name"=>$name]);
    }

    public function FindUser($name){
        return DB::table("users")->where('name',$name)->first();
    }
}
