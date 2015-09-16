<?php
namespace Nitrogen\InputFilter;

use Nitrogen\Validator\ValidatorChain;

class Input implements InputInterface
{
    /**
     * @var string name of this input
     */
    protected $name;

    /**
     * @var ValidatorChain
     */
    protected $validatorChain;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->validatorChain->isValid($this->value);
    }

    public function getMessages()
    {
        return $this->validatorChain->getMessages();
    }

    public function setValidatorChain(ValidatorChain $validatorChain)
    {
        $this->validatorChain = $validatorChain;
    }
}
