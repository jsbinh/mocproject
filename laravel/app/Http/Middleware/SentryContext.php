<?php
namespace Framework\Http\Middleware;

use Closure;
use Sentry\State\Scope;

class SentryContext
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (app()->bound('sentry')) {
            \Sentry\configureScope(function (Scope $scope): void {
                $scope->setExtra('transaction_id', app('transaction')->get());
            });

            if (auth()->check()) {
                \Sentry\configureScope(function (Scope $scope): void {
                    $scope->setUser([
                        'id' => auth()->user()->id,
                        'email' => auth()->user()->email,
                    ]);
                });
            }
        }

        return $next($request);
    }
}
