<?php
namespace Nitrogen\Validator;

use Nitrogen\Validator\Exception;

class Digits extends AbstractValidator
{
    const NOT_DIGITS   = 'digitsNotDigits';

    public function isValid($value)
    {
        $this->setValue((string) $value);

        if (!is_string($value)) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s expects a string value',
                __METHOD__
            ));
        }

        if (ctype_digit($value)) {
            return true;
        }

        $this->messages[self::NOT_DIGITS] = 'The input must contain only digits';
        return false;
    }
}
