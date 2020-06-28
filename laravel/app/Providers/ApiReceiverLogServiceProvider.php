<?php

namespace Framework\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class ApiReceiverLogServiceProvider
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
     * Log received request into storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $response
     * @param bool $async
     * @return int|null
     */
    public function log(\Illuminate\Http\Request $request, $response, $async = false) {
        $logged_at = now()->getTimestamp();
        $logged_datetime = date('Y-m-d H:i:s', $logged_at);

        $transaction_id = app('transaction')->get();

        try {
            $claims = app('api.token')->getClaims($request->header('Token'));
            $source_from = Arr::get($claims, 'iss');
            $request_at = Arr::get($claims, 'iat');
        }
        catch(\Exception $ex) {
            $source_from = Str::slug(env('APP_NAME', 'laravel'), '_');
            $request_at = now()->getTimestamp();
        }

        $response_content = $response->content();
        $response_length = strlen($response_content);

        $request = [
            'url'       => $request->url(),
            'method'    => $request->method(),
            'data'      => $request->input(),
            'headers'   => $request->header(),
        ];

        $response = [
            // 'headers' => $response->header(),
            'status_code' => $response->status()
        ];

        if ($response_length <= self::MAX_SIZE_RESPONSE) {
            $response['body'] = $response_content;
        } else {
            $response['body'] = Str::limit($response_content, self::MAX_SIZE_RESPONSE, ' (...)');
        }

        Log::info('API_RECEIVER_LOG', [compact(
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
