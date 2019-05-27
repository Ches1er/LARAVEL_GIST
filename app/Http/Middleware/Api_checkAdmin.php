<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

class Api_checkAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $token_json = Crypt::decryptString(Cookie::get('token'));
        $token = json_decode($token_json,true);
        if (is_null($token))return redirect()->route('main');
        $roles = $token['role'];
        if (in_array('Admin',$roles))return $next($request);
        return redirect()->route('main');
    }
}
