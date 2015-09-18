<?php
namespace Nitrogen\EventManager;

use Nitrogen\EventManager\EventInterface;

class EventManager implements EventManagerInterface
{
    /**
     * @var array of arrays
     */
    protected $events = [];

    /**
     * Trigger an event
     *
     * @param string $name event name
     * @param EventInterface $event the event object
     * @return array of responses (callback return values)
     */
    public function trigger($name, $event)
    {
        $responses = [];
        $listeners = $this->getListeners($name);

        foreach ($listeners as $listener) {
            $responses[] = $listener($event);
        }
        return $responses;
    }

    /**
     * Attach an event lister
     * @param string $name the name of the event
     * @param callable $callback handler
     */
    public function attach($name, callable $callback, $priority = 1)
    {
        if (empty($this->events[$name])) {
            $this->events[$name] = [];
        }

        // add the callback to the listeners
        $this->events[$name][] = $callback;
    }

    /**
     * Get a list of listeners for a given event name
     * @param string $name the event name
     * @return array
     */
    public function getListeners($name)
    {
        if (array_key_exists($name, $this->events)) {
            return $this->events[$name];
        }
        return $this->events[$name] = [];
    }
}
