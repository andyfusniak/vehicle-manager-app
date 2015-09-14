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
    protected $elements = [];

    public function __construct($name)
    {
        $this->name = (string) $name;
    }

    /**
     * Add an element or list of elements
     *
     * @param ElementInterface|array
     * @return Form
     */
    public function add($element)
    {
        if (is_array($element)) {
            foreach ($element as $e) {
                $this->add($e);
            }
            return $this;
        }

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
        if (!array_key_exists($name, $this->elements)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Element name "%s" not found',
                $name
            ));
        }
        return $this->elements[$name];
    }
}
