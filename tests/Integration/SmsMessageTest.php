<?php

declare(strict_types=1);

namespace DevelopersDesk\LaravelTwilio\Tests\Integration;

use DevelopersDesk\LaravelTwilio\Facades\Twilio;
use DevelopersDesk\LaravelTwilio\Tests\TestCase;

class SmsMessageTest extends TestCase
{
    public function testSmsReturnsAuthFailureError(): void
    {
        $this->expectExceptionMessage("Twilio Error: Authentication Error - invalid username");

        Twilio::sms("11234567890", "Jai Shree Krishn");
    }
}
