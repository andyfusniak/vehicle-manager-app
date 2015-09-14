<?php
namespace Nitrogen\Form\Element;

use Nitrogen\Form\Element;

class Select extends Element
{
    /**
     * @var array
     */
    protected $valueOptions = [];

    protected $emptyOption = null;

    /**
     * @param array $options
     * @return Select
     */
    public function setValueOptions(array $options)
    {
        $this->valueOptions = $options;
        return $this;
    }

    /**
     * @return array
     */
    public function getValueOptions()
    {
        return $this->valueOptions;
    }

    /**
     * Set the string for an empty option (can be empty string).
     * If set to null, no option will be added
     *
     * @param  string|null $emptyOption
     * @return Select
     */
    public function setEmptyOption($emptyOption)
    {
        $this->emptyOption = $emptyOption;
        return $this;
    }

    /**
     * Return the string for the empty option (null if none)
     *
     * @return string|null
     */
    public function getEmptyOption()
    {
        return $this->emptyOption;
    }
}
