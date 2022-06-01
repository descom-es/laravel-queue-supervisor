<?php

namespace Descom\Supervisor;

use Descom\Supervisor\Console\Install;
use Descom\Supervisor\Console\SupervisorRestart;
use Descom\Supervisor\Console\SupervisorStart;
use Descom\Supervisor\Console\SupervisorStatus;
use Descom\Supervisor\Console\SupervisorStop;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class SupervisorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'supervisor');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
              __DIR__.'/../config/config.php' => config_path('supervisor.php'),
            ], 'config');

            $this->registerCommands();

            $this->registerScheduling();
        }
    }

    private function registerCommands()
    {
        $this->commands([
            Install::class,
            SupervisorStatus::class,
            SupervisorStart::class,
            SupervisorStop::class,
            SupervisorRestart::class,
        ]);
    }

    private function registerScheduling()
    {
        if (! config('supervisor.schedule.start.enabled', false)) {
            return;
        }

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);

            $schedule->command('supervisor:start')->cron(
                config('supervisor.schedule.start.cron', '* * * * *')
            );
        });
    }
}
