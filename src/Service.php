<?php

namespace Descom\Supervisor;

use Descom\Supervisor\Services\StartService;
use Descom\Supervisor\Services\StatusService;
use Descom\Supervisor\Services\StopService;

class Service
{
    /**
     * return Status[]
     */
    public static function status(): array
    {
        $service = new StatusService();

        return $service->get();
    }

    /**
     * @throws Descom\Supervisor\Services\Exceptions\ExceptionWorkerIsRunning
     */
    public static function start()
    {
        $service = new StartService();

        $service->run();
    }

    /**
     * @throws Descom\Supervisor\Services\Exceptions\ExceptionWorkerIsNotRunning
     */
    public static function stop()
    {
        $service = new StopService();

        $service->run();
    }

    public static function restart()
    {
        static::stop();

        usleep(500);

        static::start();
    }
}
