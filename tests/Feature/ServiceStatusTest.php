<?php

namespace Descom\Supervisor\Tests\Feature;

use Descom\Supervisor\Service;
use Descom\Supervisor\Tests\TestCase;

class ServiceStatusTest extends TestCase
{
    public function test_empty_status_if_not_defined()
    {
        $this->app['config']->set('supervisor.workers', []);

        $this->assertCount(0, Service::status());
    }

    public function test_status_worker_disabled()
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

    public function test_status_worker_enabled()
    {
        $this->app['config']->set('supervisor.workers', [
            'worker1' => [
                'enabled' => true,
            ],
        ]);

        $workers = Service::status();

        $this->assertTrue($workers[0]->isEnabled());
    }

    public function test_status_worker_stopped()
    {
        $this->app['config']->set('supervisor.workers', [
            'worker1' => [],
        ]);

        $workers = Service::status();

        $this->assertCount(1, $workers);
        $this->assertFalse($workers[0]->isRunning());
    }

    public function test_status_worker_running()
    {
        $this->app['config']->set('supervisor.workers', [
            'worker1' => [
                'max-time' => 1,
            ],
        ]);

        Service::start();

        $workers = Service::status();

        $this->assertCount(1, $workers);
        $this->assertTrue($workers[0]->isRunning());

        Service::stop();
    }
}
