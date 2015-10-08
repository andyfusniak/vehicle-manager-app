<?php
namespace Nitrogen\ServiceManager;

use Nitrogen\ServiceManager\ServiceLocatorInterface;

abstract class AbstractPluginManager
{
    /**
     * lookup table of canonical names
     */
    protected $canonicalNames = [];

    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * cached instances
     */
    protected $instances = [];

    public function __construct(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    private function getCanonicalName($name)
    {
        // cache the value if it's not been seen before
        if (!isset($this->canonicalNames[$name])) {
            $this->canonicalNames[$name] = strtolower(strtr($name, ['-' => '']));
        }

        return $this->canonicalNames[$name];
    }

    /**
     * Get a plugin by name
     *
     * @param string $name
     * @return object
     */
    public function get($name)
    {
        $canonicalName = $this->getCanonicalName($name);

        if (isset($this->instances[$canonicalName])) {
            return $this->instances[$canonicalName];
        }

        if (isset($this->invokableClasses[$canonicalName])) {
            $instance = $this->createFromInvokable($canonicalName);
            $this->instances[$canonicalName] = $instance;
            return $instance;
        }

        $object = $this->serviceLocator->get($name);
        if ($object !== null) {
            return $object;
        }

        return null;
    }

    private function createFromInvokable($canonicalName)
    {
        $invokable = $this->invokableClasses[$canonicalName];
        if (!class_exists($invokable)) {
            throw new \Exception(sprintf(
                '%s: failed to invoke class "%s"; class does not exist',
                __METHOD__,
                $invokable
            ));
        }

        // store a copy of the helper plugin manager on board each component
        // because the escape helper is needed for form element
        $invokable = new $invokable;
        if (method_exists($invokable, 'setHelperPluginManager')) {
            $invokable->setHelperPluginManager($this);
        }
        return $invokable;
    }

    public function setInvokableClass($name, $className)
    {
        if (isset($this->canonicalNames[$name])) {
            throw new \Exception(sprintf(
                'A plugin with the name "%s" already exists and cannot be overwritten',
                    $name
            ));
        }
        $this->invokableClasses[$name] = $className;
    }
}
