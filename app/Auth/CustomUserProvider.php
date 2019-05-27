<?php

namespace App\Auth;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use App\Models\User_token;


class CustomUserProvider implements \Illuminate\Contracts\Auth\UserProvider
{

    private $users;

    /**
     * CustomUserProvider constructor.
* @param $user
*/
    public function __construct()
    {
        $this->users=User::select();
    }


    /**
     * Retrieve a user by their unique identifier.
     *
     * @param mixed $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        $user = $this->user->where('name',$identifier)->first();
        if (empty($user))return null;
        return $user;
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param mixed $identifier
     * @param string $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        $userFromTokens = User_token::where('token',$token)->first();

        if (!is_null($userFromTokens)){
            $user = $this->users->where('id',$userFromTokens->user_id)->first();
            return $user;
        }
        return null;
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param string $token
     * @return void
     */
    public function updateRememberToken(\Illuminate\Contracts\Auth\Authenticatable $user, $token)
    {
        // TODO: Implement updateRememberToken() method.
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param array $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        $user = $this->retrieveById($credentials['user_name']);
        if ($user) return $user;
        return null;
    }


    /**
     * Validate a user against the given credentials.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials(\Illuminate\Contracts\Auth\Authenticatable $user, array $credentials)
    {
        $user = $this->retrieveByCredentials($credentials);
        if ($user){
            if($user->getAuthPassword()==Hash::make($credentials['password']))return true;
            return false;
        }
        return false;
    }
}

