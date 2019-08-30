<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
          if ($guard == "admin" && Auth::guard($guard)->check()) {
                return redirect('/admin');
           }
            if ($guard == "owner" && Auth::guard($guard)->check()) {
                return redirect('/owner');
            }
            if ($guard == "staff" && Auth::guard($guard)->check()) {
                return redirect('/staff');
            }
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }

        return $next($request);
    }
}
