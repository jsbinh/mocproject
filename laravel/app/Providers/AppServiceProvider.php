<?php

namespace Framework\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Framework\Providers\TransactionServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // View::share('assetDir', env('APP_ENV') == 'production' ? 'build/' : '');
        // View::share('assetPath', env('APP_ENV') == 'production' ? 'mix' : 'asset');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('transaction', function ($app) {
            return new TransactionServiceProvider();
        });
    }
}
