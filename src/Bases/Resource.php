<?php

declare(strict_types=1);

namespace LaravelTwilio\Bases;

use Illuminate\Http\Resources\Json\JsonResource;
use stdClass;
use LaravelTwilio\Twilio;

abstract class Resource extends JsonResource
{
    public string $httpMethod = "post";
    public string $apiEndpoint = "";
    public stdClass $response;

    public function execute(): self
    {
        $response = (new Twilio())
            ->send($this);
        $this->ingest($response);

        return $this;
    }

    public function ingest(stdClass $response): self
    {
        $this->response = $response;

        return $this;
    }
}
