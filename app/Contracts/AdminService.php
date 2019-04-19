<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 18.04.2019
 * Time: 9:18
 */

namespace App\Contracts;


interface AdminService
{
    public function FindUser($name);
    public function BanUser($id);
    public function UnbanUser($id);
    public function ChangeCategoryName($old_name,$new_name);
}
