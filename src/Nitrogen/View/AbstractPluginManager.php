<?php
namespace Nitrogen\View;

abstract class AbstractPluginManager
{
    /**
     * lookup table of canonical names
     */
    protected $canonicalNames = array();

    /**
     * cached instances
     */
    protected $instances = array();

    public function __construct()
    {
    }

    private function getCanonicalName($name)
    {
        // cache the value if it's not been seen before
        if (!isset($this->canonicalNames[$name])) {
            $this->canonicalNames[$name] = strtolower(strtr($name, array('-' => '')));
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
        $invokable->setHelperPluginManager($this);
        return $invokable;
    }

}
