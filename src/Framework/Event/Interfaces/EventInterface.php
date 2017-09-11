<?php declare(strict_types=1);
namespace Onion\Framework\Event\Interfaces;

/**
 * Interface EventInterface
 * @package Framework\Event\Interfaces
 *
 * Simple value object representing an event that occurred
 */
interface EventInterface
{
    /**
     * Retrieve the name of the event
     */
    public function getName(): string;

    /**
     * Retrieve the event parameters. If no parameters
     * are available, this method must return an empty
     * array
     *
     * @return array
     */
    public function getParams(): array;

    /**
     * Retrieve a single parameters by name. If the
     * parameter is not present in the event parameters
     * the value of $default will be returned (Defaults
     * to `null`)
     *
     * @param string $name Name of the parameter to retrieve
     * @param mixed $default To return if parameter is not present
     * @return mixed
     */
    public function getParam(string $name, $default = null);

    /**
     * Retrieve the source of the event as a string.
     * A good example of the result of this function
     * could be `ClassName:triggeringMethodName` to
     * allow more detailed logging and/or error
     * reporting.
     *
     * If no source is presented this method should
     * return an empty string.
     *
     * @return string
     */
    public function getSource(): string;

    /**
     * Mark the event as terminated, indicating that
     * no further handlers should be triggered for it.
     *
     * @return void
     */
    public function terminate();

    /**
     * A method to check if an event's bubbling has
     * been terminated by any handler or not. This
     * is useful for when an event should not be
     * handled further due to a condition on one of
     * it's handlers.
     *
     * For events that never should be terminated
     * this method must return
     *
     * @return bool
     */
    public function isTerminated(): bool;
}