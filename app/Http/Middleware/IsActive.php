<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class IsActive
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
        if (Auth::check())
        {
            if (auth()->user()->isActive == 0)
            {
                Auth::logout();
                throw new AccessDeniedHttpException("Unauthorized!");
            }
        }
        return $next($request);

        /*if (auth()->user() && auth()->user()->isActive == 1){
            return $next($request);
        }else{
            Auth::logout();
            throw new AccessDeniedHttpException('Unauthorized!');
        }*/
    }
}
