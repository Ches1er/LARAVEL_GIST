<?php

namespace App\Auth;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

class CustomGuard implements \Illuminate\Contracts\Auth\Guard
{

    /**@var UserProvider
    */
    public $provider;
    public $user;

    /**
     * CustomGuard constructor.
     * @param UserProvider $provider
     */
    public function __construct(UserProvider $provider)
    {
        $this->provider = $provider;
    }


    /**
     * Determine if the current user is authenticated.
     *
     * @return bool
     */
    public function check()
    {
        $user_token = Cookie::get('token');

        if(!is_null($user_token)){
            $getUserByToken = $this->provider->retrieveByToken('',$user_token);
            if (!is_null($getUserByToken)){
                $this->user =$getUserByToken;
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * Determine if the current user is a guest.
     *
     * @return bool
     */
    public function guest()
    {
        return !$this->check();
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        if ($this->check())return $this->user;
        return null;

    }

    /**
     * Get the ID for the currently authenticated user.
     *
     * @return int|null
     */
    public function id()
    {
        if ($this->check())return $this->user->id;
        return null;
    }

    /**
     * Validate a user's credentials.
     *
     * @param array $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        $user = $this->provider->retrieveByCredentials($credentials);
        return $this->provider->validateCredentials($user,$credentials);
    }

    /**
     * Set the current user.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @return void
     */
    public function setUser(\Illuminate\Contracts\Auth\Authenticatable $user)
    {
        $this->user = $user;
    }
}
