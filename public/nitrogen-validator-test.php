<?php
chdir(dirname(__DIR__));

// Setup autoloading
require_once './vendor/autoload.php';

use Nitrogen\Validator\ValidatorChain;
use Nitrogen\Validator;

$digits = new Validator\Digits();
$stringLength = new Validator\StringLength();
$priceChain = new ValidatorChain();
$priceChain->attach($digits)
           ->attach($stringLength);

var_dump($priceChain->isValid('abc'));
var_dump($priceChain->getMessages());
