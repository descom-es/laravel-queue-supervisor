<?php

namespace Descom\Supervisor\Tests\Feature;

use Descom\Supervisor\Service;
use Descom\Supervisor\Tests\TestCase;

class ServiceStartTest extends TestCase
{
    public function testStartWorker()
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
    }
}
