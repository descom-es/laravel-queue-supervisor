<?php

namespace Descom\Supervisor\Tests\Feature;

use Descom\Supervisor\Service;
use Descom\Supervisor\Tests\TestCase;

class ServiceRestartTest extends TestCase
{
    public function testRestartWorker()
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
        $pid = $this->getPid();

        Service::restart();

        $workers = Service::status();
        $newPid = $this->getPid();

        $this->assertNotNull($newPid);
        $this->assertNotEquals($pid, $newPid);
    }

    private function getPid(): ?int
    {
        $workers = Service::status();

        return  $workers[0]->getPid();
    }
}
