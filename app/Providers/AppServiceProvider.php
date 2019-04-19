<?php

namespace App\Providers;

use App\Providers\Custom\AdminServiceProvider;
use App\Providers\Custom\CategoryServiceProvider;
use App\Providers\Custom\FileServiceProvider;
use App\Providers\Custom\GistServiceProvider;
use App\Providers\Custom\MainServiceProvider;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(AdminServiceProvider::class);
        $this->app->register(CategoryServiceProvider::class);
        $this->app->register(FileServiceProvider::class);
        $this->app->register(GistServiceProvider::class);
        $this->app->register(MainServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
