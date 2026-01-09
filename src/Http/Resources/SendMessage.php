<?php

declare(strict_types=1);

namespace LaravelTwilio\Http\Resources;

use LaravelTwilio\Bases\Resource;

class SendMessage extends Resource
{
    public function __construct(
        public string $to,
        public string $message,
    ) {
        $accountSid = config("twilio.twilio.account_sid");
        $this->apiEndpoint = "https://api.twilio.com/2010-04-01/Accounts/{$accountSid}/Messages.json";
        $this->httpMethod = "POST";
        $this->to = $to;
        $this->message = $message;
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
