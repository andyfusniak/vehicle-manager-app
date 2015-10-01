<?php
namespace Serenity\Form;

use Nitrogen\Form\Form;
use Nitrogen\Form\Element;

class AdminSignInForm extends Form
{
    public function __construct()
    {
        // username
        $username =new Element\Text('username');

        // password
        $passwd = new Element\Password('passwd');

        $this->add([
            $username,
            $passwd
        ]);
    }
}
