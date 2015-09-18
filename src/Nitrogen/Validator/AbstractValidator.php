<?php
namespace Nitrogen\Validator;

abstract class AbstractValidator implements ValidatorInterface
{
    /**
     * @var array|null
     */
    protected $messages = [];

    /**
     * @var mixed
     */
    protected $value;

    public function setValue($value)
    {
        $this->value = (string) $value;
        $this->messages = [];
    }

    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return array of error messages
     */
    public function getMessages()
    {
        return $this->messages;
    }

    //public function __invoke($value)
    //{
    //    return $this->isValid($value);
    //}
}
