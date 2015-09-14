<?php
namespace Nitrogen\Form\View\Helper;

use Nitrogen\Form\Element;
use Nitrogen\Form\ElementInterface;
use Nitrogen\Form\Exception;

class FormSelect extends AbstractHelper
{
    public function __invoke(ElementInterface $element)
    {
        return $this->render($element);
    }

    public function render(ElementInterface $element)
    {
        if (!$element instanceof Element\Select) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s expects an element of type Element\Select %s passed',
                __METHOD__,
                get_class($element)
            ));
        }

        $options = $element->getValueOptions();

        if (($emptyOption = $element->getEmptyOption()) !== null) {
            $options = ['' => $emptyOption] + $options;
        }

        return sprintf(
            '<select %s%s>%s</select>',
            $this->renderName($element->getName()),
            $this->renderAttributes($element->getAttributes()),
            $this->renderOptions($options, $element->getValue())
        );
    }

    public function renderOptions(array $options, $selectedOption)
    {
        $optionStrings = [];

        $template = '<option %s>%s</option>';

        // to do - needs escaping
        foreach ($options as $n => $v) {
            $optionStrings[] = sprintf(
                $template,
                'value="' . $n . '"',
                $v
            );
        }
        return implode("\n", $optionStrings);
    }
}
