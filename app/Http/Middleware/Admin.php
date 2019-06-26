<?php

namespace App\Http\Middleware;

use App\Admins;
use Closure;

class Admin
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
            $user = Admins::where('userId', \Auth::id())->first();

            if (!empty($user)){
                return $next($request);
            }else{
                return redirect('/');
            }
        }
        return redirect('/');
    }
}
