<?php

declare(strict_types=1);

namespace DevelopersDesk\LaravelTwilio\Bases;

use stdClass;
use DevelopersDesk\LaravelTwilio\Http\Clients\TwilioClient;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class Resource extends JsonResource
{
    public string $httpMethod = "post";
    public string $apiEndpoint = "";
    public stdClass $response;

    public function execute(): self
    {
        $response = (new TwilioClient())
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
