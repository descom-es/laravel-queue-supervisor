<?php

namespace Descom\Supervisor;

use Descom\Supervisor\Console\Install;
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

            $this->commands([
                Install::class,
            ]);
        }
    }
}
