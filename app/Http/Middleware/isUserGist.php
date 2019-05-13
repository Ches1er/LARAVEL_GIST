<?php

namespace App\Http\Middleware;

use App\Models\Gist;
use Closure;
use Illuminate\Support\Facades\Auth;

class isUserGist
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
        $user_gists = Gist::where('user_id', Auth::id());
        if ($user_gists->where('id', $request->gistid)->exists()) return $next($request);
        return redirect('/invalid_resource');
    }
}
