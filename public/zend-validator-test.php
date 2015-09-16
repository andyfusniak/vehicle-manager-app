<?php
chdir(dirname(__DIR__));

// Setup autoloading
require_once './vendor/autoload.php';

use Zend\Validator\ValidatorChain;
use Zend\Validator;

$digits = new Validator\Digits();
$stringLength = new Validator\StringLength();
$stringLength->setMax(4);
$priceChain = new ValidatorChain();
$priceChain->attach($digits)
           ->attach($stringLength);

var_dump($priceChain->isValid('abcde'));
var_dump($priceChain->getMessages());
