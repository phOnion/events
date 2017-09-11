<?php declare(strict_types=1);

namespace Onion\Framework\Event;

use Onion\Framework\Event\Interfaces\ManagerInterface;

trait ManagerAware
{
    private $eventManager;

    public function getEventManager(): ManagerInterface
    {
        if (!$this->eventManager) {
            throw new \BadMethodCallException('No instance of event manager has been set.');
        }

        return $this->eventManager;
    }

    public function setEventManager(ManagerInterface $manager)
    {
        $this->eventManager = $manager;
    }
}