<?php
namespace Nitrogen\Validator;

use Nitrogen\Validator;

class StringLength extends AbstractValidator
{
    const TOO_SHORT = 'stringLengthTooShort';

    public function isValid($value)
    {
        $this->messages[self::TOO_SHORT] = 'Way too short';
        return false;
    }
}
