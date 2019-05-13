<?php

namespace App\Http\Middleware;

use App\Models\File;
use App\Models\Gist;
use Closure;
use Illuminate\Support\Facades\Auth;

class isUserFile
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
        $file_gist = File::where('id',$request->fileid)->first();
        $user_gists = Gist::select(['id'])->where('user_id',Auth::id());
        if (!is_null($file_gist) && $user_gists->where('id',$file_gist->gist_id)->exists()) return $next($request);
        return redirect('/invalid_resource');
    }
}
