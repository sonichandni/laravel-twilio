<?php

declare(strict_types=1);

namespace DevelopersDesk\LaravelTwilio\Tests\Feature;

use Illuminate\Support\Facades\Http;
use DevelopersDesk\LaravelTwilio\Tests\TestCase;
use DevelopersDesk\LaravelTwilio\Facades\Twilio;

class SmsMessageTest extends TestCase
{
    public function testSmsSentSuccessfully(): void
    {
        Http::fake([
            "*Messages.json" => Http::response(
                $this->loadFixture("smsSentSuccessfully.json"),
            ),
        ]);

        $result = Twilio::sms("18777804236", "Jai Shree Krishn");

        $this->assertNull($result->error_message);
        $this->assertEquals(data_get($result, "status"), "queued");
    }
}
