<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\SocialiteServiceProvider;
use Laravel\Socialite\Contracts\Factory as SocialiteFactory;
use Laravel\Socialite\Two\GoogleProvider;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Ensure Socialite is registered
        $this->app->register(SocialiteServiceProvider::class);
    }

    public function boot()
    {
        // Customize the Socialite factory to use a custom Guzzle client
        $this->app->extend(SocialiteFactory::class, function ($socialite) {
            $socialite->extend('google', function ($app) use ($socialite) {
                $config = $app['config']['services.google'];
                return new GoogleProvider(
                    $app['request'],
                    $config['client_id'],
                    $config['client_secret'],
                    $config['redirect']
                );
            });

            return $socialite;
        });

        // Override the HTTP client for Google provider
        $this->app->resolving(GoogleProvider::class, function ($googleProvider) {
            $googleProvider->setHttpClient(new Client(['verify' => 'C:\xampp\php\extras\ssl\cacert.pem']));
        });
    }
}
