<?php

namespace Descom\Supervisor\Workers;

use Descom\Supervisor\Services\Exceptions\ExceptionWorkerIsNotRunning;
use Descom\Supervisor\Services\Exceptions\ExceptionWorkerIsRunning;
use Descom\Supervisor\Support\Exec;
use Descom\Supervisor\Support\Helper;

class Worker
{
    private ?int $pid = null;
    private bool $enabled;
    private string $connection;
    private array $options;

    public function __construct(private string $workerName)
    {
        $this->loadConfig();

        $this->loadPid();
    }

    public function getName(): string
    {
        return $this->workerName;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function getPid(): ?int
    {
        return $this->pid;
    }

    public function isRunning(): bool
    {
        return $this->pid !== null;
    }

    public function start(): ?int
    {
        $this->loadPid();

        if ($this->pid) {
            throw new ExceptionWorkerIsRunning($this->workerName);
        }

        return Exec::asyncRun($this->getCommand());
    }

    public function stop(): bool
    {
        $this->loadPid();

        if ($this->pid === null) {
            throw new ExceptionWorkerIsNotRunning($this->workerName);
        }

        return posix_kill($this->pid, SIGTERM);
    }

    private function getCommand(): string
    {
        $arguments = [
            PHP_BINARY,
            Helper::artisan(),
            'queue:work',
            '--name',
            '"'.$this->workerName.'"',
        ];

        foreach ($this->options as $key => $value) {
            if (is_numeric($key)) {
                $arguments[] = '--'.$value;
            } else {
                $arguments[] = '--'.$key;
                $arguments[] = $value;
            }
        }

        return implode(' ', $arguments).' '.$this->connection;
    }

    private function loadConfig(): void
    {
        $workerConfig = config('supervisor.workers.' . $this->workerName, null);

        if ($workerConfig === null) {
            throw new \Exception("Worker {$this->workerName} not found in config");
        }

        $this->enabled = isset($workerConfig['enabled']) ? $workerConfig['enabled'] : true;
        $this->connection = $workerConfig['conenction'] ?? '';
        $this->options = $workerConfig['options'] ?? [];
    }

    private function loadPid()
    {
        $this->pid = $this->findPid();
    }

    private function findPid(): ?int
    {
        $user = get_current_user();

        $output = Exec::run("ps -u {$user} -o pid,command");

        $works = array_values(array_filter($output, function ($process) {
            return stripos($process, Helper::artisanBaseName().' queue:work') !== false
                && stripos($process, "--name {$this->workerName}") !== false;
        }));


        if (count($works) === 0) {
            return null;
        }

        $work = trim($works[0]);

        [ $pid ] = explode(' ', $work);

        if ((int)$pid === 0) {
            return null;
        }

        return (int)$pid;
    }
}
