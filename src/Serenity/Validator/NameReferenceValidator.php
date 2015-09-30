<?php
namespace Serenity\Validator;

use Nitrogen\Validator\AbstractValidator;

class NameReferenceValidator extends AbstractValidator
{
    const NAME_FORMAT_INVALID = 'nameFormatInvalid';

    /**
     * @var string
     */
    //protected $regEx = '/^[A-Za-z]+/';
    protected $regEx = '/^[A-Za-z\- \']+$/';

    public function isValid($value)
    {
        var_dump($value);
        if (!is_string($value)) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s expects a string value',
                __METHOD__
            ));
        }

        if (preg_match($this->regEx, $value)) {
            return true;
        }

        $this->messages[self::NAME_FORMAT_INVALID] = 'Must use alphabetic characters including \'- characters only';
        return false;
    }
}
