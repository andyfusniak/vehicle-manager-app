<?php
chdir(dirname(__DIR__));

// Setup autoloading
require_once './vendor/autoload.php';

use Nitrogen\Validator\ValidatorChain;
use Nitrogen\Validator;
use Nitrogen\ServiceManager\HelperPluginManager;


$helperPluginManager = new HelperPluginManager();

$digits = new Validator\Digits();
$stringLength = new Validator\StringLength();
$priceChain = new ValidatorChain();
$priceChain->setHelperPluginManager($helperPluginManager);
$priceChain->attach('validatordigits')
           ->attach('validatorstringLength');

var_dump($priceChain->isValid('abc'));
var_dump($priceChain->getMessages());
