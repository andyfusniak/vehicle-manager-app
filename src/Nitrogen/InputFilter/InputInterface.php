<?php
namespace Nitrogen\InputFilter;

use Nitrogen\Validator\ValidatorChain;

interface InputInterface
{
    /**
     * @return bool
     */
    public function isValid();
    public function setValidatorChain(ValidatorChain $validatorChain);
}
