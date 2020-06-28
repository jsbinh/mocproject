<?php

namespace Framework\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ApiRequesterLogServiceProvider
{
    const MAX_SIZE_RESPONSE = 1024;

    /**
     * Create a new database api log provider.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Log api request into storage.
     *
     * @param array $request
     * @param GuzzleHttp\Promise\Promise $rawResponse
     * @param bool $async
     * @return int|null
     */
    public function log(array $request, $rawResponse, bool $async = false)
    {
        $logged_at = now()->getTimestamp();
        $logged_datetime = date('Y-m-d H:i:s', $logged_at);

        $response = [];

        if (! $async) {
            $response = [
                'headers' => $rawResponse->getHeaders(),
                'status_code' => $rawResponse->getStatusCode(),
                'protocol_version' => $rawResponse->getProtocolVersion(),
                'body' => Str::limit($rawResponse->getBody()->getContents(), self::MAX_SIZE_RESPONSE, ' (...)')
            ];
        }

        $request['params'] = $request['params'];

        $transaction_id = app('transaction')->get();

        try {
            $claims = app('api.token')->getClaims(Arr::get($request, 'headers.Token'));
            $source_from = Arr::get($claims, 'iss');
            $request_at = Arr::get($claims, 'iat');
        }
        catch(\Exception $ex) {
            $source_from = Str::slug(env('APP_NAME', 'laravel'), '_');
            $request_at = now()->getTimestamp();
        }

        Log::info('API_REQUESTER_LOG', [compact(
            'source_from',
            'transaction_id',
            'async',
            'request',
            'response',
            'logged_at',
            'logged_datetime'
        )]);
    }

}
