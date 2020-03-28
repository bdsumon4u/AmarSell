<?php

namespace App\Http\Middleware;

use Closure;
use ReflectionClass;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

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
        if (Auth::guard($guard)->check()) {
            return $guard == 'web' || $guard == null
                ? redirect(RouteServiceProvider::HOME)
                : redirect(
                    (new ReflectionClass(RouteServiceProvider::class))
                        ->getConstant($guard . '_HOME')
                );
        }

        return $next($request);
    }
}
