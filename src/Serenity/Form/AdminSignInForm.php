<?php
namespace Serenity\Form;

use Nitrogen\Form\Form;
use Nitrogen\Form\Element;
use Nitrogen\ServiceManager\HelperPluginManager;
use Nitrogen\Validator\ValidatorChain;
use Serenity\Validator\UsernameValidator;

class AdminSignInForm extends Form
{
    public function __construct(HelperPluginManager $helperPluginManager,
                                UsernameValidator $usernameValidator)
    {
        // username
        $username = new Element\Text('username');
        $usernameChain = new ValidatorChain($helperPluginManager);
        $usernameChain->attach('validatornotempty')
                      ->attach($usernameValidator);
        $username->setValidatorChain($usernameChain);

        // password
        $passwd = new Element\Password('passwd');
        $passwdChain = new ValidatorChain($helperPluginManager);
        $passwdChain->attach('validatornotempty');
        $passwd->setValidatorChain($passwdChain);

        $this->add([
            $username,
            $passwd
        ]);
    }
}
