<?php

namespace App\Providers\Custom;

use Illuminate\Support\ServiceProvider;
use App\Contracts\MainService;
use App\Services\DBMainService;

class MainServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MainService::class,DBMainService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
