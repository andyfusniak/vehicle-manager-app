<?php
namespace Nitrogen\View;

class ViewModel
{
    /**
     * View parameters
     * @var array
     */
    protected $parameters;

    /**
     * Template to use when rendering this model
     *
     * @var string
     */
    protected $template;

    public function __construct($parameters = null)
    {
        if ($parameters === null) {
            $this->parameters = array();
        }
        $this->parameters = $parameters;
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
}
