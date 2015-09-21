<?php
namespace Nitrogen\Form\View\Helper;

use Nitrogen\View\Helper\AbstractHelper as BaseHelper;
use Nitrogen\Form\ElementInterface;
use Nitrogen\Form\Exception;
use Nitrogen\View\Helper\EscapeHtml;
use Nitrogen\View\Helper\EscapeHtmlAttr;

abstract class AbstractHelper extends BaseHelper
{
    protected $booleanAttributes = [
        'autofocus',
        'checked',
        'disabled',
        'multiple',
        'readonly',
        'required',
        'selected',
    ];

    /**
     * @var EscapeHtml
     */
    protected $escapeHtmlHelper;

    /**
     * @var EscapeHtmlAttr
     */
    protected $escapeHtmlAttrHelper;

    /**
     * Retrieve the escapeHtml helper
     *
     * @return EscapeHtml
     */
    protected function getEscapeHtmlHelper()
    {
        if ($this->escapeHtmlHelper) {
            return $this->escapeHtmlHelper;
        }
        return $this->escapeHtmlHelper = $this->helperPluginManager->get('escapehtml');
    }

    /**
     * Retrieve the escapeHtmlAttr helper
     *
     * @return EscapeHtmlAttr
     */
    protected function getEscapeHtmlAttrHelper()
    {
        if ($this->escapeHtmlAttrHelper) {
            return $this->escapeHtmlAttrHelper;
        }
        return $this->escapeHtmlAttrHelper = $this->helperPluginManager->get('escapehtmlattr');
    }

    protected function renderName($name)
    {
        $escapeHtmlAttrHelper = $this->getEscapeHtmlAttrHelper();
        return 'name="' . $escapeHtmlAttrHelper($name) . '"';
    }

    protected function renderType($type)
    {
        $escapeHtmlAttrHelper = $this->getEscapeHtmlAttrHelper();
        return ' type="' . $escapeHtmlAttrHelper($type) . '"';
    }

    protected function renderAttributes(array $attributes)
    {
        $escapeHtmlHelper = $this->getEscapeHtmlHelper();
        $escapeHtmlAttrHelper = $this->getEscapeHtmlAttrHelper();

        $attributeStrings = [];

        foreach ($attributes as $name => $value) {
            if (!ctype_lower($name)) {
                throw new Exception\DomainException(sprintf(
                    '%s expects attribute names to be lowercase "%s" passed',
                    __METHOD__,
                    $name
                ));
            }

            if (in_array($name, $this->booleanAttributes)) {
                $attributeStrings[] = $escapeHtmlAttrHelper($name);
            } else {
                if (is_array($value)) {
                    $l = [];
                    foreach ($value as $i) {
                        $l[] = $escapeHtmlAttrHelper($i);
                    }
                    $value = implode(' ', $l);
                }

                $attributeStrings[] = sprintf(
                    '%s="%s"',
                    $escapeHtmlHelper($name),
                    $escapeHtmlAttrHelper($value)
                );
            }
        }
        //if (empty($attributeStrings)) {
        //    return '';
        //}
        return ' ' . implode(' ', $attributeStrings);
    }

    protected function renderValue($value)
    {
        $escapeHtmlAttrHelper = $this->getEscapeHtmlAttrHelper();
        return ' value="' . $escapeHtmlAttrHelper($value) . '"';
    }

    abstract public function render(ElementInterface $element);
}
