<?php

declare(strict_types=1);

namespace LaravelTwilio\Services;

use LaravelTwilio\Http\Clients\TwilioClient;
use LaravelTwilio\Http\Resources\SendMessage;

class Twilio
{
    public function __construct(protected TwilioClient $client)
    {
        //
    }

    public function sendMessage(string $to, string $message)
    {
        return $this->client->send(
            new SendMessage($to, $message)
        );
    }

    public static function isEnabled(): bool
    {
        return config("twilio.twilio.account_sid")
            && config("twilio.twilio.auth_token");
    }
}
