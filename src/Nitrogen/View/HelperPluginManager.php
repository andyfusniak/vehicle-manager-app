<?php
namespace Nitrogen\View;

class HelperPluginManager extends AbstractPluginManager
{
    protected $invokableClasses = array(
        'escapehtml' => 'Nitrogen\View\Helper\EscapeHtml'
    );

    public function __construct()
    {
        parent::__construct();
    }
}
