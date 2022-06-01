<?php

namespace Descom\Supervisor\Console;

use Descom\Supervisor\Service;
use Descom\Supervisor\Services\Exceptions\ExceptionWorkerIsNotRunning;
use Illuminate\Console\Command;

class SupervisorStop extends Command
{
    protected $signature = 'supervisor:stop';

    protected $description = 'Stop queue works';

    public function handle()
    {
        $workersStatus = Service::status();

        if (count($workersStatus) === 0) {
            $this->comment('No workers have been defined.');

            exit(0);
        }

        try {
            Service::stop();
        } catch (ExceptionWorkerIsNotRunning $exception) {
        }


        $this->call('supervisor:status');
    }
}
