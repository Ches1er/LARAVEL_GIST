<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 18.04.2019
 * Time: 16:08
 */

namespace App\Providers\Custom;


use Illuminate\Support\ServiceProvider;
use App\Contracts\GistService;
use App\Services\DB_GistService;

class GistServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(GistService::class,DB_GistService::class);
    }

}
