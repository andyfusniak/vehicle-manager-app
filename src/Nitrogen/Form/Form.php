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
     * @var array
     */
    protected $invalidElements;

    /**
     * Whether or not validation has occurred
     *
     * @var bool
     */
    protected $hasValidated = false;

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
                'Form element "%s" not found',
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
    public function setData(array $data)
    {
        $this->hasValidated = false;
        $this->data = $data;

        // populate the values
        foreach ($this->elements as $name => $element) {
            if (array_key_exists($name, $data)) {
                $element->setValue($data[$name]);
            } else {
                $element->setValue(null);
            }
        }
        return $this;
    }

    /**
     * @return array form data after validation
     */
    public function getData()
    {
        // although now filtering occurs we put this in now to
        // force the flow
        if (!$this->hasValidated) {
            throw new \Exception(sprintf(
                '%s cannot return data as validation has not yet occurred',
                __METHOD__
            ));
        }
        return $this->data;
    }

    public function isValid()
    {
        if ($this->data === null) {
            throw new \DomainException(sprintf(
                'You must set the data before calling %s',
                __METHOD__
            ));
        }

        $valid = true;
        $this->invalidElements = [];

        foreach ($this->elements as $name => $element) {
            if (!array_key_exists($name, $this->data)) {
                continue;
            }

            if (!$element->isValid($this->data)) {
                $this->invalidElements[$name] = $element;
                $valid = false;
            }
        }
        $this->hasValidated = true;
        return $valid;
    }

    public function getMessages()
    {
        $messages = array();
        foreach ($this->invalidElements as $name => $element) {
            $messages[$name] = $element->getMessages();
        }

        return $messages;
    }
}
