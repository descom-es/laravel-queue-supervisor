<?php

namespace Descom\Supervisor\Services;

use Descom\Supervisor\Workers\Worker;

class StartService extends AbstractService
{
    public function run(): void
    {
        array_map(
            function (Worker $worker) {
                $worker->start();
            },
            $this->workers()
        );
    }
}
