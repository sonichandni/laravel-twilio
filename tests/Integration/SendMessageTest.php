<?php

declare(strict_types=1);

namespace LaravelTwilio\Tests\Integration;

use LaravelTwilio\Http\Resources\SendMessage;
use LaravelTwilio\Tests\TestCase;

class SendMessageTest extends TestCase
{
    public function testSendMessageReturnsAuthFailureError(): void
    {
        $this->expectExceptionMessage("Twilio Error: Authentication Error - invalid username");

        (new SendMessage("18777804236", "Jai Shree Krishn"))
            ->execute()
            ->response;
    }
}
