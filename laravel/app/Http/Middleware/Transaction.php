<?php

namespace Framework\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Transaction
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        $transaction_id = $request->header('Transaction');

        if (!empty($transaction_id)) app('transaction')->set($transaction_id);

        if (empty(app('transaction')->get())) app('transaction')->generate();

        return $next($request);
    }
}
