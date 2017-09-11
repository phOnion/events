<?php declare(strict_types=1);

namespace Onion\Framework\Event;

use Onion\Framework\Event\Interfaces\EventInterface;
use Onion\Framework\Event\Interfaces\EventTargetInterface;
use Onion\Framework\Event\Interfaces\HandlerInterface;
use Onion\Framework\Event\Interfaces\ManagerInterface;

class Manager implements ManagerInterface
{
    /**
     * @var HandlerInterface[][][]
     */
    private $listeners = [];

    /**
     * Register an event with the current handler
     *
     * @param string $name
     * @param HandlerInterface $handler
     * @param int $priority
     * @return void
     */
    public function attach(string $name, HandlerInterface $handler, int $priority = 1)
    {
        $this->listeners[$name][] = [$handler, $priority];
        usort($this->listeners[$name], function ($a, $b) {
            return $b[1] <=> $a[1];
        });
    }

    /**
     * Remove a handler from listening for an event
     *
     * @param string $name
     * @param HandlerInterface $handler
     * @return void
     */
    public function detach(string $name, HandlerInterface $handler)
    {
        if (isset($this->listeners[$name])) {
            if (($index=array_search($handler, $this->listeners[$name])) !== false) {
                unset($this->listeners[$name][$index]);
            }
        }
    }

    /**
     * Remove all registered handlers for an event
     *
     * @param string $name
     * @return void
     */
    public function clear(string $name)
    {
        if (isset($this->listeners[$name])) {
            $this->listeners[$name] = [];
        }
    }

    /**
     * @param EventInterface $event
     * @param EventTargetInterface $target
     *
     * @return void
     */
    public function trigger(EventInterface $event, EventTargetInterface $target)
    {
        if (isset($this->listeners[$event->getName()])) {
            foreach ($this->listeners[$event->getName()] as $listener) {
                if ($event->isTerminated()) {
                    break;
                }

                $target = $listener[0]->handle($event, $target);
            }
        }
    }
}