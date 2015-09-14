<?php
namespace Nitrogen\View;

class HelperPluginManager extends AbstractPluginManager
{
    protected $invokableClasses = [ 
        'escapehtml'     => 'Nitrogen\View\Helper\EscapeHtml',
        'escapehtmlattr' => 'Nitrogen\View\Helper\EscapeHtmlAttr',
        'forminput'      => 'Nitrogen\Form\View\Helper\FormInput',
        'formselect'     => 'Nitrogen\Form\View\Helper\FormSelect',
        'formtextarea'   => 'Nitrogen\Form\View\Helper\FormTextarea'
    ];

    public function __construct()
    {
        parent::__construct();
    }
}
