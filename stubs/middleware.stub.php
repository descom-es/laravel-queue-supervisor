<?php

namespace Descom\Supervisor\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SupervisorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
