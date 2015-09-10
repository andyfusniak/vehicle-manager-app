<?php
namespace Nitrogen\Form;

interface ElementInterface
{
    public function setName($name);
    public function getName();
    public function setValue($value);
    public function getValue();
}
