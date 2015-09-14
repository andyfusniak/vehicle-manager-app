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

    //public function setType($type)
    //{
    //    $this->type = (string) $type;
    //    return $this;
    //}
    //
    public function getType()
    {
        $parts = explode('\\', get_class($this));
        return strtolower($parts[count($parts) - 1]);
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
