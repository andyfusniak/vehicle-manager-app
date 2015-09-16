<?php
namespace Nitrogen\Validator;

use Nitrogen\Validator\ValidatorInterface;

class ValidatorChain implements ValidatorInterface
{
    /**
     * @var array of Validator objects
     */
    protected $validators = [];

    /**
     * @var array|null
     */
    protected $messages;

    public function attach(ValidatorInterface $validator)
    {
        $this->validators[] = $validator;
        return $this;
    }

    public function isValid($value)
    {
        $this->messages = [];
        $result = true;

        foreach ($this->validators as $validator) {
            if (!$validator->isValid($value)) {
                $result = false;
                $this->messages = array_replace_recursive(
                    $this->messages,
                    $validator->getMessages()
                );
            }
        }
        return $result;
    }

    public function getMessages()
    {
        return $this->messages;
    }
}
