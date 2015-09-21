<?php
namespace Serenity\Form;

use Nitrogen\Form\Form;
use Nitrogen\Form\Element;
use Nitrogen\ServiceManager\HelperPluginManager;

class ImageUploadForm extends Form
{
    public function __construct(HelperPluginManager $helperPluginManager)
    {
        $filename = new Element\File('filename');

        $caption = new Element\Text('caption');

        $this->add([
            $filename,
            $caption
        ]);
    }
}
