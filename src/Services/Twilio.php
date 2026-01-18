<?php

declare(strict_types=1);

namespace DevelopersDesk\LaravelTwilio\Services;

use RuntimeException;
use DevelopersDesk\LaravelTwilio\Http\Clients\TwilioClient;
use DevelopersDesk\LaravelTwilio\Http\Resources\SmsMessage;
use DevelopersDesk\LaravelTwilio\Http\Resources\WhatsAppTemplateMessage;

class Twilio
{
    public function __construct(protected TwilioClient $client)
    {
        //
    }

    public function sms(string $to, string $message)
    {
        if (! $this->isEnabled()) {
            throw new RuntimeException(
                "Twilio credentials are not configured."
            );
        }

        return $this->client
            ->send(
                new SmsMessage($to, $message)
            );
    }

    public function whatsapp(
        string $to,
        string $contentSid,
        array $variables = []
    ) {
        if (! $this->isEnabled()) {
            throw new RuntimeException(
                "Twilio credentials are not configured."
            );
        }

        return $this->client
            ->send(
                new WhatsAppTemplateMessage(
                    $to,
                    $contentSid,
                    $variables
                )
            );
    }

    public function isEnabled(): bool
    {
        return filled(config("twilio.twilio.account_sid"))
            && filled(config("twilio.twilio.auth_token"));
    }
}
