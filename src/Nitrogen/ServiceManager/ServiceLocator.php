<?php
namespace Nitrogen\ServiceManager;

class ServiceLocator implements ServiceLocatorInterface
{
    protected $instances = [];
    protected $services = [];

    /**
     * Get an instance
     * @param string $name
     * @return object
     */
    public function get($name)
    {
        if (isset($this->instances[$name])) {
            return $this->instances[$name];
        }

        $object = $this->services[$name];
        if (isset($object)) {
            if (is_string($object)) {
                $object = new $object();
            }

            if ($object instanceof FactoryInterface) {
                $factory = new $object();
                return $this->instances[$name] = $factory->createService($this);
            } else if (is_array($object)) {
                return $this->instances[$name] = $object;
            } else if (is_object($object)) {
                return $this->instance[$name] = $object;
            }
        }

        return null;
    }

    /**
     * Register a factory with the service locator
     * @param string|array $name the name under which to register this factory
     * @param mixed $factory the factory which creates this object
     * @return ServiceLocator
     */
    public function setService($name, $factory = null)
    {
        if (is_array($name)) {
            foreach ($name as $n => $f) {
                $this->setService($n, $f);
            }
            return $this;
        }
        $this->services[$name] = $factory;
        return $this;
    }
}
