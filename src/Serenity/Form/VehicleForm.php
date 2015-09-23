<?php
namespace Serenity\Form;

use Nitrogen\Form\Form;
use Nitrogen\Form\Element;
use Nitrogen\ServiceManager\HelperPluginManager;
use Nitrogen\Validator\ValidatorChain;

use Serenity\Validator\VehicleUrlTakenValidator;

class VehicleForm extends Form
{
    public function __construct(HelperPluginManager $helperPluginManager,
                                VehicleUrlTakenValidator $vehicleUrlTakenValidator)
    {
        $vehicleId = new Element\Hidden('vehicle-id');
        //$vehicleIdChain = new ValidatorChain($helperPluginManager);
        //$vehicleIdChain->attach('validatornotempty');
        //$vehicleId->setValidatorChain($vehicleIdChain);

        // type
        $type = new Element\Select('type');
        $type->setValueOptions(array(
            'caravans'    => 'Caravans',
            'motorhomes'  => 'Motorhomes',
            'awningrange' => 'Awning Range',
            'accessories' => 'Accessories',
            'cars'        => 'Cars'
        ))->setEmptyOption('--select--');
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

        // url
        $url = new Element\Text('url');
        $urlChain = new ValidatorChain($helperPluginManager);
        $urlChain->attach('validatornotempty')
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
        $metaDesc = new Element\Textarea('meta-desc');

        // page-title
        $pageTitle = new Element\Text('page-title');

        // markdown
        $markdown = new Element\Textarea('markdown');

        $this->add([
            $vehicleId,
            $type,
            $visible,
            $sold,
            $url,
            $price,
            $metaKeywords,
            $metaDesc,
            $pageTitle,
            $markdown
        ]);
    }
}
