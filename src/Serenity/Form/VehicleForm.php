<?php
namespace Serenity\Form;

use Nitrogen\Form\Form;
use Nitrogen\Form\Element;
use Nitrogen\ServiceManager\HelperPluginManager;
use Nitrogen\Validator\ValidatorChain;

class VehicleForm extends Form
{
    public function __construct(HelperPluginManager $helperPluginManager)
    {
        $vehicleId = new Element\Hidden('vehicle-id');
        $type = new Element\Select('type');
        $type->setValueOptions(array(
            'caravans'    => 'Caravans',
            'motorhomes'  => 'Motorhomes',
            'awningrange' => 'Awning Range',
            'accessories' => 'Accessories',
            'cars'        => 'Cars'
        ))->setEmptyOption('--select--');

        $visible = new Element\Select('visible');
        $visible->setValueOptions(array(
            '1' => 'Yes',
            '0' => 'No'
        ));

        $sold = new Element\Select('sold');
        $sold->setValueOptions(array(
            '0' => 'No',
            '1' => 'Yes',
        ));

        $url = new Element\Text('url');

        $price = new Element\Text('price');
        $priceChain = new ValidatorChain($helperPluginManager);
        $priceChain->attach('validatordigits')
                   ->attach('validatorstringlength');
        $price->setValidatorChain($priceChain);

        $metaKeywords = new Element\Textarea('meta-keywords');
        $metaDesc = new Element\Textarea('meta-desc');

        $pageTitle = new Element\Text('page-title');

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
