<?php
namespace Nitrogen\Form;

class Element implements ElementInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @var string
     */
    protected $value;

    public function __construct($name = null)
    {
        if (empty($name)) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s: constructor called without a unique name',
                get_class($this)
            ));
        }
        $this->setName($name);
    }

    public function setName($name)
    {
        $this->name = (string) $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        $parts = explode('\\', get_class($this));
        return strtolower($parts[count($parts) - 1]);
    }

    /**
     * Set an element attribute name value pair
     *
     * @param string $name html attribute name
     * @param string|array $value html value
     * @return Element
     */
    public function setAttribute($name, $value = '')
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    /**
     * Get an html attribute by name
     *
     * @param string $name html attribute name
     * @return string|null attribute value or null if not found
     */
    public function getAttribute($name)
    {
        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        }
        return null;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function setValue($value)
    {
        $this->value = (string) $value;
        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }
}
