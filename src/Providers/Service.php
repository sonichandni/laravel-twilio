<?php

declare(strict_types=1);

namespace DevelopersDesk\LaravelTwilio\Providers;

use Illuminate\Support\ServiceProvider as BaseProvider;
use DevelopersDesk\LaravelTwilio\Services\Twilio as TwilioService;
use DevelopersDesk\LaravelTwilio\Http\Clients\TwilioClient;

class Service extends BaseProvider
{
    public function register(): void
    {
        $this->app->singleton(TwilioClient::class);
        $this->app->singleton("laravel-twilio", TwilioService::class);

        $this->mergeConfigFrom(
            __DIR__ . "/../../config/twilio.php",
            "twilio"
        );
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . "/../../config/twilio.php" => config_path("twilio.php"),
        ], "twilio-config");
    }
}
