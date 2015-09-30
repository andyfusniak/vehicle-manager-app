<?php
namespace Serenity\Form;

use Nitrogen\Form\Form;
use Nitrogen\Form\Element;
use Nitrogen\ServiceManager\HelperPluginManager;
use Nitrogen\Validator\ValidatorChain;

use Serenity\Service\VehicleService;
use Serenity\Validator\CollectionTagnameTakenValidator;
use Serenity\Validator\NameReferenceValidator;
use Serenity\Validator\SlugValidator;

class CollectionForm extends Form
{
    public function __construct(HelperPluginManager $helperPluginManager,
                                CollectionTagnameTakenValidator $collectionTakenameTakenValidator,
                                NameReferenceValidator $nameReferenceValidator,
                                SlugValidator $slugValidator)
    {
        // collection-id
        $collectionId = new Element\Hidden('collection-id');

        // name
        $name = new Element\Text('name');
        $nameChain = new ValidatorChain($helperPluginManager);
        $nameChain->attach('validatornotempty')
                  ->attach($nameReferenceValidator);
        $name->setValidatorChain($nameChain);

        // tagname
        $tagname = new Element\Text('tagname');
        $tagnameChain = new ValidatorChain($helperPluginManager);
        $tagnameChain->attach('validatornotempty')
                     ->attach($slugValidator)
                     ->attach($collectionTakenameTakenValidator);
        $tagname->setValidatorChain($tagnameChain);

        $this->add([
            $collectionId,
            $name,
            $tagname
        ]);
    }
}
