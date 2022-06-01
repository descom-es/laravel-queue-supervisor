<?php

namespace Descom\Supervisor\Console;

use Descom\Supervisor\Service;
use Descom\Supervisor\Services\Exceptions\ExceptionWorkerIsNotRunning;
use Descom\Supervisor\Services\Exceptions\ExceptionWorkerIsRunning;
use Illuminate\Console\Command;

class SupervisorRestart extends Command
{
    protected $signature = 'supervisor:restart';

    protected $description = 'Restart queue works';

    public function handle()
    {
        $workersStatus = Service::status();

        if (count($workersStatus) === 0) {
            $this->comment('No workers have been defined.');

            exit(0);
        }

        try {
            Service::restart();
        } catch (ExceptionWorkerIsRunning|ExceptionWorkerIsNotRunning $exception) {
        }

        $this->call('supervisor:status');
    }
}
