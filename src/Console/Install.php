<?php

namespace Descom\Supervisor\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Install extends Command
{
    protected $signature = 'supervisor:install';

    protected $description = 'Install package Supervisor';

    public function handle()
    {
        $this->info('Installing package Supervisor...');

        $this->info('Publishing configuration...');

        if (! $this->configExists('supervisor.php')) {
            $this->publishConfiguration();
        } else {
            if ($this->shouldOverwriteConfig()) {
                $this->publishConfiguration($force = true);
            } else {
                $this->info('Existing configuration was not overwritten');
            }
        }

        $this->info('Installed package Supervisor');
    }

    private function configExists($fileName)
    {
        return File::exists(config_path($fileName));
    }

    private function shouldOverwriteConfig()
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    private function publishConfiguration($forcePublish = false)
    {
        $this->info('Overwriting configuration file...');

        $params = [
            '--provider' => "Descom\Supervisor\SupervisorServiceProvider",
            '--tag' => 'config',
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);

        $this->info('Published configuration');
    }
}
