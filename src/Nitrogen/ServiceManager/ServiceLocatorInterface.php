<?php
namespace Nitrogen\ServiceManager;

interface ServiceLocatorInterface
{
    /**
     * Get an instance of the named service
     * @param string $name
     * @return object
     */
    public function get($name);
}
