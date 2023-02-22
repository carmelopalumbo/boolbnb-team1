<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Gateway::class, function($app){
            return new Gateway(
                [

                    'environment' => 'sandbox',
                    'merchantId' => 'mmfft3qkgsqqnq95',
                    'publicKey' => 'ghznff2zqy9v4vfh',
                    'privateKey' => '613be495e8c055aeca1d012037ab3505'
                ]
                );
        });
    }
}
