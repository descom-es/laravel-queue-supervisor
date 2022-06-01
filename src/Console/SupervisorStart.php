<?php

namespace Descom\Supervisor\Console;

use Descom\Supervisor\Service;
use Descom\Supervisor\Services\Exceptions\ExceptionWorkerIsRunning;
use Illuminate\Console\Command;

class SupervisorStart extends Command
{
    protected $signature = 'supervisor:start';

    protected $description = 'Start queue works';

    public function handle()
    {
        $workersStatus = Service::status();

        if (count($workersStatus) === 0) {
            $this->comment('No workers have been defined.');

            exit(0);
        }

        try {
            Service::start();
        } catch (ExceptionWorkerIsRunning $exception) {}


       $this->call('supervisor:status');
    }
}
