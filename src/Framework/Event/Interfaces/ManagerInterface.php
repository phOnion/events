<?php declare(strict_types=1);

namespace Onion\Framework\Event\Interfaces;

/**
 * Interface ManagerInterface
 * @package Framework\Event\Interfaces
 *
 * Skeleton of an event orchestrator
 */
interface ManagerInterface
{
    /**
     * Register an event with the current handler
     *
     * @param string $name
     * @param HandlerInterface $handler
     * @param int $priority
     * @return void
     */
    public function attach(string $name, HandlerInterface $handler, int $priority = 1);

    /**
     * Remove a handler from listening for an event
     *
     * @param string $name
     * @param HandlerInterface $handler
     * @return void
     */
    public function detach(string $name, HandlerInterface $handler);

    /**
     * Remove all registered handlers for an event
     *
     * @param string $name
     * @return void
     */
    public function clear(string $name);

    /**
     * @param EventInterface $event
     * @param EventTargetInterface $target
     *
     * @return mixed
     */
    public function trigger(EventInterface $event, EventTargetInterface $target = null);
}