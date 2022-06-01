<?php

namespace Descom\Supervisor\Tests\Feature;

use Descom\Supervisor\Service;
use Descom\Supervisor\Tests\TestCase;

class ServiceStatusTest extends TestCase
{
    public function testEmptyStatusIfNotDefined()
    {
        $this->app['config']->set('supervisor.workers', []);

        $this->assertCount(0, Service::status());
    }

    public function testStatusWorkerDisabled()
    {
        $this->app['config']->set('supervisor.workers', [
            'worker1' => [
                'enabled' => false,
            ],
        ]);

        $workers = Service::status();

        $this->assertCount(1, $workers);
        $this->assertFalse($workers[0]->isEnabled());
    }

    public function testStatusWorkerEnabled()
    {
        $this->app['config']->set('supervisor.workers', [
            'worker1' => [
                'enabled' => true,
            ],
        ]);

        $workers = Service::status();

        $this->assertTrue($workers[0]->isEnabled());
    }

    public function testStatusWorkerStopped()
    {
        $this->app['config']->set('supervisor.workers', [
            'worker1' => [],
        ]);

        $workers = Service::status();

        $this->assertCount(1, $workers);
        $this->assertFalse($workers[0]->isRunning());
    }

    public function testStatusWorkerRunning()
    {
        $this->app['config']->set('supervisor.workers', [
            'worker1' => [
                'options' => [
                    'max-time' => 1,
                ],
            ],
        ]);

        Service::start();

        $workers = Service::status();

        $this->assertCount(1, $workers);
        $this->assertTrue($workers[0]->isRunning());

        Service::stop();
    }
}
