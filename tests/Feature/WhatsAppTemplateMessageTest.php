<?php

declare(strict_types=1);

namespace DevelopersDesk\LaravelTwilio\Tests\Feature;

use Illuminate\Support\Facades\Http;
use DevelopersDesk\LaravelTwilio\Tests\TestCase;
use DevelopersDesk\LaravelTwilio\Facades\Twilio;

class WhatsAppTemplateMessageTest extends TestCase
{
    public function testWhatsappMessageSentSuccessfully(): void
    {
        Http::fake([
            "*Messages.json" => Http::response(
                $this->loadFixture("whatsappMessageSentSuccessfully.json"),
            ),
        ]);

        $result = Twilio::whatsapp(
            "11234567890",
            "HXxxxxxxxxxxxxxxxxxxxxxxx",
            [
                "1" => "17-January-2026",
                "2" => "5pm",
            ]
        );

        $this->assertNull($result->error_message);
        $this->assertEquals(data_get($result, "status"), "queued");
    }
}
