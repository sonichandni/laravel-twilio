<?php

declare(strict_types=1);

namespace DevelopersDesk\LaravelTwilio\Http\Resources;

use DevelopersDesk\LaravelTwilio\Bases\Resource;

class WhatsAppTemplateMessage extends Resource
{
    public string $httpMethod = "post";

    public string $apiEndpoint;

    public function __construct(
        protected string $to,
        protected string $contentSid,
        protected array $variables = []
    ) {
        $this->apiEndpoint =
            "https://api.twilio.com/2010-04-01/Accounts/" .
            config("twilio.twilio.account_sid") .
            "/Messages.json";
    }

    public function toArray($request): array
    {
        return [
            "To" => $this->formatWhatsApp($this->to),
            "From" => $this->formatWhatsApp(
                config("twilio.twilio.from_whatsapp")
            ),
            "ContentSid" => $this->contentSid,
            "ContentVariables" => json_encode($this->variables),
        ];
    }

    protected function formatWhatsApp(string $number): string
    {
        return str_starts_with($number, "whatsapp:")
            ? $number
            : "whatsapp:" . $number;
    }
}
