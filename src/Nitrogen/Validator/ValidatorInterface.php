<?php
namespace Nitrogen\Validator;

interface ValidatorInterface
{
    /**
     * @param mixed $value
     * @return bool
     */
    public function isValid($value);

    /**
     * @return array of error messages
     */
    public function getMessages();
}
