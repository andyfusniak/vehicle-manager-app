<?php
namespace Serenity\Form;

use Nitrogen\Form\Form;
use Nitrogen\Form\Element;
use Nitrogen\ServiceManager\HelperPluginManager;
use Nitrogen\Validator\ValidatorChain;

use Serenity\Service\VehicleService;
use Serenity\Validator\CollectionTagnameTakenValidator;

class CollectionForm extends Form
{
    public function __construct(HelperPluginManager $helperPluginManager,
                                CollectionTagnameTakenValidator $collectionTakenameTakenValidator)
    {
        // collection-id
        $collectionId = new Element\Hidden('collection-id');


        // tagname
        $tagname = new Element\Text('tagname');
        $tagnameChain = new ValidatorChain($helperPluginManager);
        $tagnameChain->attach('validatornotempty')
                     ->attach($collectionTakenameTakenValidator);
        $tagname->setValidatorChain($tagnameChain);


        // name
        $name = new Element\Text('name');
        $nameChain = new ValidatorChain($helperPluginManager);
        $nameChain->attach('validatornotempty');
        $name->setValidatorChain($nameChain);

        $this->add([
            $collectionId,
            $tagname,
            $name
        ]);
    }
}
