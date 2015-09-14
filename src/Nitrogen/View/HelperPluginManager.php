<?php
namespace Nitrogen\View;

class HelperPluginManager extends AbstractPluginManager
{
    protected $invokableClasses = array(
        'escapehtml' => 'Nitrogen\View\Helper\EscapeHtml',
        'forminput'  => 'Nitrogen\Form\View\Helper\FormInput'
    );

    public function __construct()
    {
        parent::__construct();
    }
}
