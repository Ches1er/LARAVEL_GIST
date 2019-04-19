<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 18.04.2019
 * Time: 11:29
 */

namespace App\Providers\Custom;


use App\Contracts\CategoryService;
use App\Services\DBCategoryService;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CategoryService::class,
            DBCategoryService::class
        );
    }

}
