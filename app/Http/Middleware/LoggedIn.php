<?php

namespace App\Http\Middleware;

use App\Admins;
use Closure;

class LoggedIn
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
        if (\Auth::check()){
            return $next($request);
        }
        return redirect('/');
    }
}
