<?php

namespace Descom\Supervisor\Support;

use Symfony\Component\Process\Process;

class Exec
{
    public static function run(string $command): array
    {
        exec($command, $output, $exitCode);

        if ($exitCode !== 0) {
            throw new \Exception("Error executing \"{$command}\" command");
        }

        return $output;
    }

    public static function asyncRun(string $command): void
    {
        exec('/usr/bin/nohup ' . $command . " > /dev/null 2>&1 &" );
    }
}
