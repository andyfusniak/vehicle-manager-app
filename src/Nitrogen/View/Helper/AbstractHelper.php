<?php
namespace Nitrogen\View\Helper;

use Nitrogen\View\HelperPluginManager;

abstract class AbstractHelper
{
    /**
     * Default encoding
     */
    protected $encoding = 'utf-8';

    /**
     * @var HelperPluginManager
     */
    protected $helperPluginManager;

    public function setHelperPluginManager(HelperPluginManager $helperPluginManager)
    {
        $this->helperPluginManager = $helperPluginManager;
        return $this;
    }
}
