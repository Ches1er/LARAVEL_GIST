<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsValidUser
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
            $user_roles = Auth::user()->roles();
            $invalid = false;
            if (in_array(\Roles_constants::INVALID_USER,$user_roles))$invalid = true;
            if (Auth::user() &&  !$invalid) {
                return $next($request);
            }
            return redirect('/invalid_user');
    }
}
