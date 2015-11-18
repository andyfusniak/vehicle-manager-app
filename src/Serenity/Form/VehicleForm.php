<?php
namespace Serenity\Form;

use Nitrogen\Form\Form;
use Nitrogen\Form\Element;
use Nitrogen\ServiceManager\HelperPluginManager;
use Nitrogen\Validator\ValidatorChain;

use Serenity\Service\CollectionService;
use Serenity\Validator\SlugValidator;
use Serenity\Validator\VehicleUrlTakenValidator;

class VehicleForm extends Form
{
    public function __construct(HelperPluginManager $helperPluginManager,
                                VehicleUrlTakenValidator $vehicleUrlTakenValidator,
                                SlugValidator $slugValidator,
                                CollectionService $collectionService)
    {
        $vehicleId = new Element\Hidden('vehicle-id');
        //$vehicleIdChain = new ValidatorChain($helperPluginManager);
        //$vehicleIdChain->attach('validatornotempty');
        //$vehicleId->setValidatorChain($vehicleIdChain);

        // collection-id
        $collections = $collectionService->selectBoxCollections();
        $collectionId = new Element\Select('collection-id');
        $collectionId->setValueOptions($collections)->setEmptyOption('--select--');
        $collectionIdChain = new ValidatorChain($helperPluginManager);
        $collectionIdChain->attach('validatornotempty');
        $collectionId->setValidatorChain($collectionIdChain);

        // type
        $type = new Element\Select('type');
        $type->setValueOptions([
            'caravans'    => 'Caravans',
            'motorhomes'  => 'Motorhomes',
            'awningrange' => 'Awning Range'
        ])->setEmptyOption('--select--');
        $typeChain = new ValidatorChain($helperPluginManager);
        $typeChain->attach('validatornotempty');
        $type->setValidatorChain($typeChain);

        // visible
        $visible = new Element\Select('visible');
        $visible->setValueOptions(array(
            '1' => 'Yes',
            '0' => 'No'
        ));

        // sold
        $sold = new Element\Select('sold');
        $sold->setValueOptions(array(
            '0' => 'No',
            '1' => 'Yes',
        ));

        // new
        $new = new Element\Select('new');
        $new->setValueOptions(array(
            '0' => 'No',
            '1' => 'Yes',
        ));

        // url
        $url = new Element\Text('url');
        $urlChain = new ValidatorChain($helperPluginManager);
        $urlChain->attach('validatornotempty')
                 ->attach($slugValidator)
                 ->attach($vehicleUrlTakenValidator);
        $url->setValidatorChain($urlChain);

        // price
        $price = new Element\Text('price');
        $priceChain = new ValidatorChain($helperPluginManager);
        $priceChain->attach('validatordigits')
                   ->attach('validatorstringlength');
        $price->setValidatorChain($priceChain);

        // meta-keywords
        $metaKeywords = new Element\Textarea('meta-keywords');

        // meta-desc
        $metaDesc = new Element\Textarea('meta-desc');

        // page-title
        $pageTitle = new Element\Text('page-title');

        // markdown
        $markdown = new Element\Textarea('markdown');

        $this->add([
            $vehicleId,
            $collectionId,
            $type,
            $visible,
            $sold,
            $new,
            $url,
            $price,
            $metaKeywords,
            $metaDesc,
            $pageTitle,
            $markdown
        ]);
    }
}
