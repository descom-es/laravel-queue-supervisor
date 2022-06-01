<?php

namespace Descom\Supervisor\Services;

use Descom\Supervisor\Workers\Worker;

abstract class AbstractService
{
    protected function workers(bool $disabled = false): array
    {
        return array_map(
            fn ($workerName) => new Worker($workerName),
            $this->getWorkersMame($disabled)
        );
    }

    protected function getWorkersMame(bool $disabled): array
    {
        if ($disabled) {
            return array_keys(config('supervisor.workers', []));
        }

        $enabledWorkers = array_filter(
            config('supervisor.workers', []),
            fn ($worker) => $worker['enabled'] ?? true
        );

        return array_keys($enabledWorkers);
    }
}
