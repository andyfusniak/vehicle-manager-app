<?php
namespace Nitrogen\Form\View\Helper;

use Nitrogen\Form\ElementInterface;

class FormFile extends AbstractHelper
{
    public function __invoke(ElementInterface $element)
    {
        return $this->render($element);
    }

    public function render(ElementInterface $element)
    {
        $name = $element->getName();
        if (array_key_exists('multiple', $element->getAttributes())) {
            $name .= '[]';
        }

        return sprintf(
            '<input %s%s%s%s>',
            $this->renderName($name),
            $this->renderType($element->getType()),
            $this->renderAttributes($element->getAttributes()),
            $this->renderValue($element->getValue())
        );
    }
}
