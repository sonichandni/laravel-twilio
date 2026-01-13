<?php

declare(strict_types=1);

namespace LaravelTwilio\Providers;

use Illuminate\Support\ServiceProvider as BaseProvider;
use LaravelTwilio\Services\Twilio as TwilioService;
use LaravelTwilio\Http\Clients\TwilioClient;

class Service extends BaseProvider
{
    public function register(): void
    {
        $this->app->singleton(TwilioClient::class);
        $this->app->singleton('laravel-twilio', TwilioService::class);

        $this->mergeConfigFrom(
            __DIR__ . '/../../config/twilio.php',
            'twilio'
        );
    }

    public function boot(): void
    {
        // publishing, commands, routes, etc (later)
    }
}
