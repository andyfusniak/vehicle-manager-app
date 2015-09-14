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

        $this->add($username)
             ->add($passwordElement);
    }
}
