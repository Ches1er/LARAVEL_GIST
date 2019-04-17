<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
      public function handle($request, Closure $next,$role)
      {
          $user_roles = Auth::user()->roles();
          $isRole = false;
          if (in_array($role,$user_roles))$isRole = true;
          if (Auth::user() &&  $isRole) {
              return $next($request);
          }
          $role = lcfirst($role);
          $redirect_path = '/not'.$role;
          return redirect($redirect_path);
      }
}
