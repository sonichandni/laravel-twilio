<?php

declare(strict_types=1);

namespace DevelopersDesk\LaravelTwilio\Facades;

use Illuminate\Support\Facades\Facade;

class Twilio extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return "laravel-twilio";
    }
}
