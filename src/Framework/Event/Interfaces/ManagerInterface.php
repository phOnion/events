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
     * @param callable $handler
     * @param int $priority
     * @return void
     */
    public function attach(string $name, callable $handler, int $priority = 1);

    /**
     * Remove a handler from listening for an event
     *
     * @param string $name
     * @param callable $handler
     * @return void
     */
    public function detach(string $name, callable $handler);

    /**
     * Remove all registered handlers for an event
     *
     * @param string $name
     * @return void
     */
    public function clear(string $name);

    /**
     * @param EventInterface $event
     * @param object $source
     *
     * @return mixed
     */
    public function trigger(EventInterface $event, $source = null);
}