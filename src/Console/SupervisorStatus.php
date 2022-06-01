<?php

namespace Descom\Supervisor\Console;

use Descom\Supervisor\Service;
use Descom\Supervisor\Workers\Status;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\TableCellStyle;
use Symfony\Component\Console\Helper\TableStyle;

class SupervisorStatus extends Command
{
    protected $signature = 'supervisor:status';

    protected $description = 'Get status of process queue works';

    public function handle()
    {
        $workersStatus = Service::status();

        if (count($workersStatus) === 0) {
            $this->comment('No workers have been defined.');

            exit(0);
        }

        $this->output->writeln('');

        $this->table(
            [],
            array_map(
                fn (Status $status) => [
                    '<fg=blue>'.strtoupper($status->getName()).'</>',
                    $status->isRunning() ? '  <fg=green>running</fg=green>' : '<fg=red>stopped</fg=red>',
                    $status->isEnabled() ? '' : '<fg=#333>disabled</fg=#333>',
                    $status->isRunning() ? "<fg=#333>pid: {$status->getPid()}</fg=#333>" : '',

                ],
                $workersStatus
            ),
            'compact',
        );

        $this->output->writeln('');
    }
}
