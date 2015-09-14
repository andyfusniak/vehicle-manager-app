<?php
namespace Nitrogen\Form\View\Helper;

use Nitrogen\Form\Element;
use Nitrogen\Form\ElementInterface;
use Nitrogen\Form\Exception;

class FormTextarea extends AbstractHelper
{
    public function __invoke(ElementInterface $element)
    {
        return $this->render($element);
    }

    public function render(ElementInterface $element)
    {
        $escapeHtmlPlugin = $this->helperPluginManager->get('escapehtml');

        // TODO: needs escaping
        return sprintf(
            '<textarea %s%s>%s</textarea>',
            $this->renderName($element->getName()),
            $this->renderAttributes($element->getAttributes()),
            $escapeHtmlPlugin($element->getValue())
        );
    }
}
