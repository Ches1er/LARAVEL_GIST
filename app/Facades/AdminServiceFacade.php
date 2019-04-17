<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 17.04.2019
 * Time: 17:08
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class AdminServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'AdminService';
    }
}
