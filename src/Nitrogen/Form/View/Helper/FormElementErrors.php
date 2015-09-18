<?php
namespace Nitrogen\Form\View\Helper;

use Nitrogen\Form\ElementInterface;

class FormElementErrors extends AbstractHelper
{
    /**
     * @param ElementInterface $element
     */
    public function __invoke(ElementInterface $element)
    {
        return $this->render($element);
    }

    /**
     * @param ElementInterface $element
     */
    public function render(ElementInterface $element)
    {
        $messages = $element->getMessages();

        if (($messages === null) || (empty($messages))) {
            return '';
        }

        $escapeHtmlHelper = $this->getEscapeHtmlHelper();
        $html = '<ul>';
        foreach ($messages as $msg) {
            $html .= '<li>' . $escapeHtmlHelper($msg) . '</li>';
        }
        $html .= '</ul>';

        return $html;
    }
}
