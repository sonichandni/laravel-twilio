<?php

declare(strict_types=1);

namespace LaravelTwilio\Tests\Feature;

use Illuminate\Support\Facades\Http;
use LaravelTwilio\Http\Resources\SendMessage;
use LaravelTwilio\Tests\TestCase;
use LaravelTwilio\Facades\Twilio;

class SendMessageTest extends TestCase
{
    public function testSendMessageSuccessfully(): void
    {
        Http::fake([
            "*Messages.json" => Http::response(
                $this->loadFixture("messageSentSuccessfully.json"),
            ),
        ]);

        $result = Twilio::sendMessage("18777804236", "Jai Shree Krishn");

        $this->assertNull($result->error_message);
        $this->assertEquals(data_get($result, "status"), "queued");
    }
}
