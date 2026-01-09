<?php

declare(strict_types=1);

namespace LaravelTwilio\Providers;

use Illuminate\Support\ServiceProvider as BaseProvider;

class Service extends BaseProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/twilio.php',
            'twilio'
        );
    }

    public function boot(): void
    {
        // publishing, commands, routes, etc (later)
    }


    public static function isEnabled(): bool
    {
        return config("twilio.twilio.account_sid")
            && config("twilio.twilio.auth_token");
    }
}
