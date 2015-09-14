<?php
namespace Nitrogen\Form\View\Helper;

use Nitrogen\Form\ElementInterface;

class FormInput extends AbstractHelper
{
    public function __invoke(ElementInterface $element)
    {
        return $this->render($element);
    }

    public function render(ElementInterface $element)
    {
        return sprintf(
            '<input %s%s%s%s>',
            $this->renderName($element->getName()),
            $this->renderType($element->getType()),
            $this->renderAttributes($element->getAttributes()),
            $this->renderValue($element->getValue())
        );
    }
}
