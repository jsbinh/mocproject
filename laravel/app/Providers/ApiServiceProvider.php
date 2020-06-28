<?php

namespace Framework\Providers;

use Illuminate\Support\ServiceProvider;
use Framework\Api\RESTful;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register api services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('api.restful', function($app) {
            return new RESTful();
        });

        $this->app->singleton('api.log.requester', function ($app) {
            return new ApiRequesterLogServiceProvider();
        });

        $this->app->singleton('api.log.receiver', function ($app) {
            return new ApiReceiverLogServiceProvider();
        });

        $this->app->singleton('api.token', function ($app) {
            return new \Leo\JWT\JWT(config('api'));
        });

    }
}
