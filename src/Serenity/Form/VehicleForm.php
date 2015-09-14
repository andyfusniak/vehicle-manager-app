<?php
namespace Serenity\Form;

use Nitrogen\Form\Form;
use Nitrogen\Form\Element;

class VehicleForm extends Form
{
    public function __construct()
    {
        $username = new Element\Text();
        $username->setName('username');
                 //->setValue('andy@greycatmedia.co.uk');

        $passwordElement = new Element\Password('passwd');
        $passwordElement->setValue('apples');

        $vehicleType = new Element\Select('vehicle-type');
        $vehicleType->setValueOptions(array(
            'caravans'    => 'Caravans aaa',
            'motorhomes'  => 'Motorhomes',
            'awningrange' => 'Awning Range',
            'accessories' => 'Accessories',
            'cars'        => 'Cars'
        ))->setEmptyOption('--select--');

        $this->add($username)
             ->add($vehicleType)
             ->add($passwordElement);
    }
}
