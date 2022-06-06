<?php

namespace Descom\Supervisor\Tests\Feature;

use Descom\Supervisor\Service;
use Descom\Supervisor\Tests\TestCase;

class ServiceRunTest extends TestCase
{
    public function testStatusWorkerRunning()
    {
        $this->app['config']->set('supervisor.workers', [
            'worker1' => [
                'options' => [
                    'max-time' => 3,
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
