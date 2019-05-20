<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

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
        $token = json_decode(Cookie::get('token'),true);
        if (is_null($token))return redirect()->route('main');
        $roles = $token['role'];
        if (in_array('Admin',$roles))return $next($request);
        return redirect()->route('main');
    }
}
