<?php declare(strict_types=1);

namespace Onion\Framework\Event;

use Onion\Framework\Event\Interfaces\EventInterface;
use Onion\Framework\Event\Interfaces\ManagerInterface;

class Manager implements ManagerInterface
{
    /**
     * @var callable[][][]
     */
    private $listeners = [];

    /**
     * Register an event with the current handler
     *
     * @param string $name
     * @param callable $handler
     * @param int $priority
     * @return void
     */
    public function attach(string $name, callable $handler, int $priority = 1)
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
     * @param callable $handler
     * @return void
     */
    public function detach(string $name, callable $handler)
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
     * @param object $source
     *
     * @return void
     */
    public function trigger(EventInterface $event, $source = null)
    {
        if (isset($this->listeners[$event->getName()])) {
            foreach ($this->listeners[$event->getName()] as $listener) {
                if ($event->isTerminated()) {
                    break;
                }

                $listener[0]($event, $source);
            }

            $parts = explode('.',$event->getName());
            array_pop($parts);
            $this->trigger(new Event(implode('.', $parts), $event->getParams()), $source);
        }
    }
}