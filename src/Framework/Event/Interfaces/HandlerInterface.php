<?php declare(strict_types=1);

namespace Onion\Framework\Event\Interfaces;

/**
 * Interface HandlerInterface
 * @package Framework\Event\Interfaces
 *
 * Skeleton for the event handlers
 */
interface HandlerInterface
{
    /**
     * The method invoked when an event is received
     * where the current object is registered as a
     * handler. The implementation must return the
     * provided target to allow handling of
     * immutable objects
     *
     * @param EventInterface $event
     * @param EventTargetInterface $target
     * @return EventTargetInterface
     */
    public function handle(EventInterface $event, EventTargetInterface $target): EventTargetInterface;
}