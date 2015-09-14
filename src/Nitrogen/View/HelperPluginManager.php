<?php
namespace Nitrogen\View;

class HelperPluginManager extends AbstractPluginManager
{
    protected $invokableClasses = array(
        'escapehtml' => 'Nitrogen\View\Helper\EscapeHtml',
        'forminput'  => 'Nitrogen\Form\View\Helper\FormInput',
        'formselect' => 'Nitrogen\Form\View\Helper\FormSelect'
    );

    public function __construct()
    {
        parent::__construct();
    }
}
