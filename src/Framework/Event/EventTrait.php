<?php declare(strict_types=1);

namespace Onion\Framework\Event;

trait EventTrait
{
    private $params = [];
    private $terminated = false;

    protected function setParams(array $params)
    {
        $this->params = $params;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function getParam(string $name, $default = null)
    {
        return $this->params[$name] ?? $default;
    }

    public function terminate()
    {
        $this->terminated = true;
    }

    public function isTerminated(): bool
    {
        return (bool) $this->terminated;
    }
}