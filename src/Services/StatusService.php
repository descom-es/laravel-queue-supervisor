<?php

namespace Descom\Supervisor\Services;

use Descom\Supervisor\Workers\Status;
use Descom\Supervisor\Workers\Worker;

class StatusService extends AbstractService
{
    public function get(): array
    {
        return array_map(
            fn (Worker $worker) => new Status(
                $worker->getName(),
                $worker->isEnabled(),
                $worker->getPid(),
            ),
            $this->workers(true)
        );
    }
}
