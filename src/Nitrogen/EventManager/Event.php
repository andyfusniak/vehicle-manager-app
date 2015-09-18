<?php
namespace Nitrogen\EventManager;

class Event implements EventInterface
{
    const EVENT_BOOTSTRAP = 'bootstrap';
    const EVENT_ROUTE     = 'route';
    const EVENT_DISPATCH  = 'dispatch';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var object
     */
    protected $target;

    public function __construct($name = null, $target = null)
    {
        if ($name !== null) {
            $this->name = (string) $name;
        }

        if ($target !== null) {
            $this->target = $target;
        }
    }
}
