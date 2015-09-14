<?php
namespace Nitrogen\View;

class HelperPluginManager extends AbstractPluginManager
{
    protected $invokableClasses = [
        'escapehtml'     => 'Nitrogen\View\Helper\EscapeHtml',
        'escapehtmlattr' => 'Nitrogen\View\Helper\EscapeHtmlAttr',
        'formhidden'     => 'Nitrogen\Form\View\Helper\FormHidden',
        'formselect'     => 'Nitrogen\Form\View\Helper\FormSelect',
        'formtext'       => 'Nitrogen\Form\View\Helper\FormText',
        'formtextarea'   => 'Nitrogen\Form\View\Helper\FormTextarea'
    ];

    public function __construct()
    {
        parent::__construct();
    }
}
