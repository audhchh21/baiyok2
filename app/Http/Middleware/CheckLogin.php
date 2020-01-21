<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckLogin
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
        if(Auth::check() == true)
        {
            $user = Auth::user()->type;
            if($user === 'Admin')
            {
                return redirect()->route('admin.dashboard');
            }
            else if($user === 'Manager')
            {
                return redirect()->route('manager.dashboard');
            }
            else if($user === 'User')
            {
                return redirect()->route('member.dashboard');
            }
        }
        return $next($request);
    }
}
