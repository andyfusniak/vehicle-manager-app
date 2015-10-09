<?php
namespace Serenity\Validator;

use Nitrogen\Validator\AbstractValidator;

class SlugValidator extends AbstractValidator
{
    const SLUG_FORMAT_INVALID = 'slugFormatInvalid';
    const SLUG_ENDS_WITH_HYPHEN = 'slugEndsWithHyphen';

    /**
     * @var string
     */
    protected $regEx = '/^[a-z0-9-]+[a-z0-9]$/';

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


        if (substr($value, -1) === '-') {
            $this->messages[self::SLUG_ENDS_WITH_HYPHEN] = 'Must not end with a hyphen character';
        }

        $this->messages[self::SLUG_FORMAT_INVALID] = 'Must use lowercase a to z and the hypen character only';
        return false;
    }
}
