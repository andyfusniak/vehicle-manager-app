<?php
namespace Nitrogen\InputFilter;

use Nitrogen\InputFilter\Input;

class InputFilter
{
    /**
     * @var array|null data to use when validating and filtering
     */
    protected $data;

    protected $inputs = [];

    protected $invalidInputs;

    public function add(Input $input)
    {
        $name = $input->getName();
        $this->inputs[$name] = $input;
        return $this;
    }

    public function get($name)
    {
        return $this->inputs[$name];
    }

    public function setData($data)
    {
        $this->data = $data;
        $this->populate();
        return $this;
    }

    public function populate()
    {
        foreach ($this->inputs as $name => $input) {
            if (array_key_exists($name, $this->data)) {
                $input->setValue($this->data[$name]);
            } else {
                $input->setValue(null);
            }
        }
    }

    public function isValid()
    {
        $valid = true;
        $this->invalidInputs = [];

        foreach ($this->inputs as $name => $input) {
            if (!array_key_exists($name, $this->data)) {
                var_dump("Skipping " . $name);
                continue;
            }

            if (!$input->isValid()) {
                $this->invalidInputs[$name] = $input;
                $valid = false;
            }
        }

        return $valid;
    }

    public function getMessages()
    {
        $messages = array();
        foreach ($this->invalidInputs as $name => $input) {
            $messages[$name] = $input->getMessages();
        }

        return $messages;
    }
}
