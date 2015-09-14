<?php
namespace Nitrogen\View;

class ViewModel
{
    /**
     * Parent model capture to
     */
    protected $captureTo;

    /**
     * Child models
     * @var array
     */
    protected $children = [];

    /**
     * View variables
     * @var array
     */
    protected $variables;

    /**
     * Template to use when rendering this model
     *
     * @var string
     */
    protected $template;

    public function __construct($variables = [])
    {
        if ($variables === null) {
            $this->variables = [];
        }
        $this->variables = $variables;
    }

    /**
     * Set view variable
     *
     * @param  string $name
     * @param  mixed $value
     * @return ViewModel
     */
    public function setVariable($name, $value)
    {
        $this->variables[(string) $name] = $value;
        return $this;
    }

    /**
     * Get the view variables
     *
     * @return array
     */
    public function getVariables()
    {
        return $this->variables;
    }

    /**
     * Set the template to be used by this model
     *
     * @param  string $template
     * @return ViewModel
     */
    public function setTemplate($template)
    {
        $this->template = (string) $template;
        return $this;
    }

    /**
     * Get the template to be used by this model
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    public function addChild(ViewModel $child)
    {
        $this->children[] = $child;
        return $this;
    }

    /**
     * Return all children
     *
     * @return array
     */
    public function getChildren()
    {
        return $this->children;
    }

    public function hasChildren()
    {
        return (count($this->children) > 0);
    }

    /**
     * Set the name of the variable to capture this model to, if it is a child model
     *
     * @param  string $capture
     * @return ViewModel
     */
    public function setCaptureTo($capture)
    {
        $this->captureTo = (string) $capture;
        return $this;
    }

    /**
     * Get the name of the variable to which to capture this model
     *
     * @return string
     */
    public function captureTo()
    {
        return $this->captureTo;
    }
}
