<?php

namespace App\Providers\Custom;

use Illuminate\Support\ServiceProvider;
use App\Contracts\ProfileService;
use App\Services\DBProfileService;

class ProfileServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProfileService::class,DBProfileService::class);
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
