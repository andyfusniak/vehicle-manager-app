<?php
namespace Nitrogen\Form;

interface ElementInterface
{
    public function setName($name);
    public function getName();
    public function getType();
    public function getAttributes();
    public function setValue($value);
    public function getValue();
}
