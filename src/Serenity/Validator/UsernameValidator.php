<?php
namespace Serenity\Validator;

use Nitrogen\Validator\AbstractValidator;

class UsernameValidator extends AbstractValidator
{
    const USERNAME_FORMAT_INVALID = 'usernameFormatInvalid';

    /**
     * @var string
     */
    protected $regEx = '/^[a-z]{4,16}$/';

    public function isValid($value)
    {
        if (!is_string($value)) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s expects a string value',
                __METHOD__
            ));
        }

        if (preg_match($this->regEx, $value)) {
            return true;
        }

        $this->messages[self::USERNAME_FORMAT_INVALID] = 'Usernames are lowercase a-z only between 4 to 12 characters';
        return false;
    }
}
