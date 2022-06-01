<?php

namespace Descom\Supervisor\Services;

use Descom\Supervisor\Workers\Worker;

class StopService extends AbstractService
{
    public function run(): void
    {
        array_map(
            function (Worker $worker) {
                $worker->stop();
            },
            $this->workers()
        );
    }
}
