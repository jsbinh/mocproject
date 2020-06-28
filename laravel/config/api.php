<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Logging Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log settings for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Settings: "single", "monthly", "daily"
    |
    */
    'log_requester' => [
        'database' => env('DB_CONNECTION', 'mysql'),
        'table' => 'api_requester_log',
        'log' => 'monthly'
    ],
    'log_receiver' => [
        'database' => env('DB_CONNECTION', 'mysql'),
        'table' => 'api_receiver_log',
        'log' => 'monthly'
    ],

    'jwt' => [
        'app_name' => env('APP_NAME', 'laravel'),

        /*
        |--------------------------------------------------------------------------
        | JWT App ID
        |--------------------------------------------------------------------------
        |
        | Configures the id (jti claim), replicating as a header item
        |
        */
        'app_id' => env('JWT_API_APP_ID', 'laravel'),

        /*
        |--------------------------------------------------------------------------
        | JWT Authentication Secret
        |--------------------------------------------------------------------------
        |
        | Don't forget to set this in your .env file, as it will be used to sign
        | your tokens. A helper command is provided for this:
        | `php artisan jwt:secret -s`
        |
        */
        'secret' => env('JWT_API_SECRET', 'secret_key'),

        /*
        |--------------------------------------------------------------------------
        | JWT time to live
        |--------------------------------------------------------------------------
        |
        | Specify the length of time (in seconds) that the token will be valid for.
        | Defaults to 5 minutes.
        |
        | You can also set this to null, to yield a never expiring token.
        | Some people may want this behaviour for e.g. a mobile app.
        | This is not particularly recommended, so make sure you have appropriate
        | systems in place to revoke the token if necessary.
        |
        */

        'ttl' => env('JWT_API_TTL', 300),

        /*
        |--------------------------------------------------------------------------
        | JWT Authentication Secrets of Parties
        |--------------------------------------------------------------------------
        |
        | Specify the secrets of parties for jwt token validation
        |
        */
        'parties' => array_key_by(json_decode(env('JWT_API_PARTIES', '[]'), true), '0'),
    ]
];
