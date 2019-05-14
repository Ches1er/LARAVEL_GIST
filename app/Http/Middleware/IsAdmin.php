<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        $isAdmin = false;
        if (in_array(\Roles_constants::ADMIN,$user_roles))$isAdmin = true;
        if (Auth::user() &&  $isAdmin) {
            return $next($request);
        }
        return redirect('/');
    }
}
