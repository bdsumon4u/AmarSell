<?php

namespace App\Http\Middleware;

use Closure;
use Exception;

class IsVerified
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
        return $request->user()->verified_at
            ? $next($request)
            : redirect('/');
    }
}
