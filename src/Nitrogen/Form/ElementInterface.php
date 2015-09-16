<?php
namespace Nitrogen\Form;

use Nitrogen\Validator\ValidatorChain;

interface ElementInterface
{
    public function setName($name);
    public function getName();
    public function getType();
    public function getAttributes();
    public function setValue($value);
    public function getValue();

    /**
     * @return bool
     */
    public function isValid();

    /**
     * @param ValidatorChain $validatorChain
     */
    public function setValidatorChain(ValidatorChain $validatorChain);
}
