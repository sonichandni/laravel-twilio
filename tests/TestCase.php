<?php

namespace LaravelTwilio\Tests;

use LaravelTwilio\Providers\Service;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            Service::class,
        ];
    }

    protected function loadFixture(string $fileName): string
    {
        return file_get_contents(__DIR__ . "/Fixtures/{$fileName}");
    }
}
