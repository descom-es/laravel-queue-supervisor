<?php

namespace Descom\Supervisor\Services\Exceptions;

use Exception;

class ExceptionWorkerIsRunning extends Exception
{
    public function __construct(string $workerName)
    {
        parent::__construct("Worker '{$workerName}' is already running.");
    }
}
