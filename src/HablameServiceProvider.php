<?php

namespace NotificationChannels\Hablame;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class HablameServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // Bootstrap code here.

        $this->app->when(HablameChannel::class)
            ->needs(Client::class)
            ->give(function () {
                return new Client();
            });


    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
