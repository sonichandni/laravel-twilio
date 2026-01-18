<?php

declare(strict_types=1);

namespace DevelopersDesk\LaravelTwilio\Http\Resources;

use DevelopersDesk\LaravelTwilio\Bases\Resource;

class SmsMessage extends Resource
{
    public string $httpMethod = "post";

    public string $apiEndpoint;

    public function __construct(
        protected string $to,
        protected string $message
    ) {
        $this->apiEndpoint =
            "https://api.twilio.com/2010-04-01/Accounts/" .
            config("twilio.twilio.account_sid") .
            "/Messages.json";
    }

    public function toArray($request): array
    {
        return [
            "To" => $this->to,
            "From" => config("twilio.twilio.from"),
            "Body" => $this->message,
        ];
    }
}
