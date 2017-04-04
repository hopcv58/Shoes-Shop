<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminRedirectIfAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(Auth::guard($guard)->check()){
<<<<<<< HEAD
            return redirect('adminTalaha/dashboard');
=======
            return redirect('admin/dashboard');
>>>>>>> 8d1ce6ac7c83a492e89cc269a0c9db471b164c9a
        }
        return $next($request);
    }
}
