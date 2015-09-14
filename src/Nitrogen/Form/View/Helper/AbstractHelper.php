<?php
namespace Nitrogen\Form\View\Helper;

use Nitrogen\Form\ElementInterface;

abstract class AbstractHelper
{
    abstract public function render(ElementInterface $element);

    protected function renderName($name)
    {
        // TODO: needs escaping which requires the HelperPluginManager
        return 'name="' . $name . '"';
    }

    protected function renderType($type)
    {
        return ' type="' . $type . '"';
    }

    protected function renderAttributes(array $attributes)
    {
        return '';
    }

    protected function renderValue($value)
    {
        // TODO: needs escaping
        return ' value="' . $value . '"';
    }
}
