<?php

namespace Framework\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ApiRequest
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        app('api.log.receiver')->log($request, $response);

        return $response;
    }
}
