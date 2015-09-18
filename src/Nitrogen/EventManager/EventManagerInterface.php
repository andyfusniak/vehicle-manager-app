<?php
namespace Nitrogen\EventManager;

interface EventManagerInterface
{
    /**
     * Trigger an event
     *
     * @param string $name event name
     * @param EventInterface $event the event object
     */
    public function trigger($name, $event);

    /**
     * Attach an event lister
     * @param string $name the name of the event
     * @param callable $callback handler
     */
    public function attach($name, callable $callback, $priority = 1);

    /**
     * Get a list of listeners for a given event name
     * @param string $name the event name
     * @return array
     */
    public function getListeners($name);
}
