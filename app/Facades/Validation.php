<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 19.04.2019
 * Time: 12:02
 */

namespace App\Facades;

use App\Services\ValidationService;
use Illuminate\Support\Facades\Facade;

class Validation extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ValidationService::class;
    }
}
