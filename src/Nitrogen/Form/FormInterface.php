<?php
namespace Nitrogen\Form;

use Nitrogen\Form\Element;
use Nitrogen\Validator\ValidatorChain;

interface FormInterface
{
    /**
     * @param Element|array $element the form element or array of elements
     * @return FormInterface fluent interface
     */
    public function add($element);

    /**
     * @param string $name the name of the element object to retrieve
     * @return Element the element with the given name
     */
    public function get($name);
}
