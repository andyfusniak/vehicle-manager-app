<?php
namespace Nitrogen\Form;

use Nitrogen\Validator\ValidatorChain;

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

    /**
     * @var ValidatorChain
     */
    protected $validatorChain;

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

    /**
     * @param array|null $context
     * @return bool
     */
    public function isValid($context = null)
    {
        // if there are no validators attached for this element
        // then it is assumed to be valid
        if ($this->validatorChain === null) {
            return true;
        }
        return $this->validatorChain->isValid($this->value, $context);
    }

    /**
     * @return array associative array of name error messages
     */
    public function getMessages()
    {
        if ($this->validatorChain === null) {
            return null;
        }
        return $this->validatorChain->getMessages();
    }

    /**
     * @param ValidatorChain $validatorChain chain of validators
     * @return Element
     */
    public function setValidatorChain(ValidatorChain $validatorChain)
    {
        $this->validatorChain = $validatorChain;
        return $this;
    }
}
