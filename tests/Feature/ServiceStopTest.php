<?php

namespace Descom\Supervisor\Tests\Feature;

use Descom\Supervisor\Service;
use Descom\Supervisor\Tests\TestCase;

class ServiceStopTest extends TestCase
{
    public function testStopWorker()
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
        $this->assertTrue($workers[0]->isRunning());

        Service::stop();

        $workers = Service::status();
        $this->assertFalse($workers[0]->isRunning());
    }
}
