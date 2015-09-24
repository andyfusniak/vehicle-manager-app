<?php
namespace Serenity\Form;

use Nitrogen\Form\Form;
use Nitrogen\Form\Element;
use Nitrogen\ServiceManager\HelperPluginManager;

use Nitrogen\Validator\ValidatorChain;

class ImageUploadForm extends Form
{
    public function __construct(HelperPluginManager $helperPluginManager,
                                array $collectionValueOptions)
    {
        // filename
        $filename = new Element\File('filename');

        // collection-id
        $collectionId = new Element\Select('collection-id');
        $collectionId->setValueOptions($collectionValueOptions)->setEmptyOption('--collection--');
        $collectionChain = new ValidatorChain($helperPluginManager);
        $collectionChain->attach('validatornotempty');
        $collectionId->setValidatorChain($collectionChain);

        $this->add([
            $filename,
            $collectionId
        ]);
    }
}
