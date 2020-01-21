<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ManagerLogin
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
        if(Auth::check() == true && Auth::user()->type === 'Manager')
        {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
