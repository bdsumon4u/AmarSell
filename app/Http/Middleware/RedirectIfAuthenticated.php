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
            $var = $guard . '_HOME';
            $class = new ReflectionClass(RouteServiceProvider::class);
            $const = $class->getConstant($var);
            return $guard == 'web' || $guard == null
                ? redirect(RouteServiceProvider::HOME)
                : redirect($const);
        }

        return $next($request);
    }
}
