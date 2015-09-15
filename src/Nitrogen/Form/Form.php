<?php
namespace Nitrogen\Form;

use Nitrogen\Form\Element;

class Form implements FormInterface
{
    /**
     * @var array|null data to be validated
     */
    protected $data;

    /**
     * @var array
     */
    protected $elements = [];

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

    /**
     * Set the data to be validated
     *
     * @param array $data to be validated
     * @return Form
     */
    public function setData($data)
    {
        $this->data = $data;

        // populate the values
        foreach ($this->elements as $name => $element) {
            if (array_key_exists($name, $data)) {
                $element->setValue($data[$name]);
            }
        }
        return $this;
    }
}
