<?php
namespace Nitrogen\ServiceManager;

class HelperPluginManager extends AbstractPluginManager
{
    protected $invokableClasses = [
        'escapehtml'            => 'Nitrogen\View\Helper\EscapeHtml',
        'escapehtmlattr'        => 'Nitrogen\View\Helper\EscapeHtmlAttr',
        'formhidden'            => 'Nitrogen\Form\View\Helper\FormHidden',
        'formselect'            => 'Nitrogen\Form\View\Helper\FormSelect',
        'formtext'              => 'Nitrogen\Form\View\Helper\FormText',
        'formtextarea'          => 'Nitrogen\Form\View\Helper\FormTextarea',
        'formelementerrors'      => 'Nitrogen\Form\View\Helper\FormElementErrors',
        'validatordigits'       => 'Nitrogen\Validator\Digits',
        'validatorstringlength' => 'Nitrogen\Validator\StringLength'
    ];

    public function __construct()
    {
        parent::__construct();
    }
}
