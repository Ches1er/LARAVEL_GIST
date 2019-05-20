<?php

namespace App\Providers;


use App\Auth\CustomGuard;
use App\Auth\CustomUserProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::provider('custom',function($app){
            return new CustomUserProvider();
        });
        Auth::extend('token',function ($app,$name,$config){
            return new CustomGuard(Auth::createUserProvider($config['provider']));
        });
    }
}
