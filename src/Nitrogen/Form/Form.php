<?php
namespace Nitrogen\Form;

use Nitrogen\Form\Element;

class Form implements FormInterface
{
    /**
     * @var string name of the form
     */
    protected $name;

    /**
     * @var array
     */
    protected $elements = array();

    public function __construct($name)
    {
        $this->name = (string) $name;
    }

    public function add(Element $element)
    {
        $name = $element->getName();

        if (($name === null) || ($name === '')) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s: element has no name',
                __METHOD__
            ));
        }
        $this->elements[$name] = $element;
        return $this;
    }

    public function get($name)
    {
        if (!in_array($name, $this->elements)) {
            throw new Exception\InvalidElementException(sprintf(
                'Element name "%s" not found',
                $name
            ));
        }
        return $this->elements[$name];
    }
}
