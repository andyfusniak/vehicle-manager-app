<?php
namespace Nitrogen\Form;

use Nitrogen\Form\Element;

interface FormInterface
{
    public function add(Element $element);
    public function get($name);
}
