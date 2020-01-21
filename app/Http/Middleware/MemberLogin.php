<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class MemberLogin
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
        if(Auth::check() == true && Auth::user()->type === 'User')
        {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
