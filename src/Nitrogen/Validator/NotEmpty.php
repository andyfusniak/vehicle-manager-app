<?php
namespace Nitrogen\Validator;

class NotEmpty extends AbstractValidator
{
    const IS_EMPTY = 'isEmpty';

    public function isValid($value)
    {
        if (!is_string($value)) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s expects a string value',
                __METHOD__
            ));
        }
        $this->setValue($value);

        if (strlen($value) < 1) {
            $this->messages[self::IS_EMPTY] = 'This field is required';
            return false;
        }

        return true;
    }
}
