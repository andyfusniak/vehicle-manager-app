<?php
namespace Nitrogen\ServiceManager;

class HelperPluginManager extends AbstractPluginManager
{
    protected $invokableClasses = [
        'escapehtml'            => 'Nitrogen\View\Helper\EscapeHtml',
        'escapehtmlattr'        => 'Nitrogen\View\Helper\EscapeHtmlAttr',
        'formelementerrors'     => 'Nitrogen\Form\View\Helper\FormElementErrors',
        'formfile'              => 'Nitrogen\Form\View\Helper\FormFile',
        'formhidden'            => 'Nitrogen\Form\View\Helper\FormHidden',
        'formselect'            => 'Nitrogen\Form\View\Helper\FormSelect',
        'formtext'              => 'Nitrogen\Form\View\Helper\FormText',
        'formtextarea'          => 'Nitrogen\Form\View\Helper\FormTextarea',
        'showdatetime'          => 'Nitrogen\View\Helper\ShowDateTime',
        'validatordigits'       => 'Nitrogen\Validator\Digits',
        'validatornotempty'     => 'Nitrogen\Validator\NotEmpty',
        'validatorstringlength' => 'Nitrogen\Validator\StringLength'
    ];

    public function __construct()
    {
        parent::__construct();
    }
}
