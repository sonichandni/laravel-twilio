<?php

declare(strict_types=1);

namespace LaravelTwilio;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use stdClass;
use LaravelTwilio\Bases\Resource;

class Twilio
{
    public function send(Resource $request): stdClass
    {
        $response = Http::withBasicAuth(
            config("twilio.twilio.account_sid"),
            config("twilio.twilio.auth_token")
        )
            ->withHeaders([
                "Content-Type" => "application/json",
            ])
            ->asForm()
            ->{$request->httpMethod}(
                "{$request->apiEndpoint}",
                $request->toArray(request()),
            );
        $status = $response->status();
        $response = $this->decodeResponse($response->body(), $status);
        $this->validate($response, $status);

        return $response;
    }

    protected function decodeResponse(string $response, int $status): stdClass
    {
        if (
            Str::contains($response, "The resource cannot be found.")
            || Str::contains($response, "Runtime Error")
            || Str::startsWith($response, "<!DOCTYPE html>")
        ) {
            throw new Exception(
                "Twilio: Something Went Wrong.",
                $status,
            );
        }

        $response = preg_replace('/[\x00-\x1F\x80-\xFF]/', "", $response);

        return json_decode($response);
    }

    // phpcs:ignore SlevomatCodingStandard.Functions.FunctionLength.FunctionLength, SlevomatCodingStandard.Complexity.Cognitive.ComplexityTooHigh
    protected function validate(stdClass $response, int $status): void
    {
        if (
            $status === 200
            || $status === 201
        ) {
            return;
        }

        $message = data_get($response, "message");

        throw new Exception("Twilio Error: {$message}");
    }
}
