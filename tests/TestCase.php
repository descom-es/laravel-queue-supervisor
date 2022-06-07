<?php

namespace Descom\Supervisor\Tests;

use Descom\Supervisor\Service;
use Descom\Supervisor\SupervisorServiceProvider;
use Exception;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    public function tearDown(): void
    {
        try {
            Service::stop();
        } catch (Exception $exception) {}

        parent::tearDown();
    }

    protected function getPackageProviders($app)
    {
        return [
            SupervisorServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup

        $app['config']->set('supervisor.workers', []);
    }
}
