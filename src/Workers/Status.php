<?php

namespace Descom\Supervisor\Workers;

class Status
{
    public function __construct(
        private string $workerName,
        private bool $enabled,
        private ?int $pid,
    )
    {
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
}
