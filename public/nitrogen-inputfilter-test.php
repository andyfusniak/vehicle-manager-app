<?php
chdir(dirname(__DIR__));

// Setup autoloading
require_once './vendor/autoload.php';

use Nitrogen\ServiceManager\HelperPluginManager;
use Nitrogen\Validator\ValidatorChain;
use Nitrogen\Validator\Digits;

use Nitrogen\InputFilter\InputFilter;
use Nitrogen\InputFilter\Input;

// validators
$digitsValidator = new Digits();
$validators = new ValidatorChain();
$validators->setHelperPluginManager(new HelperPluginManager());
$validators->attach('validatordigits');

// input filter
$inputFilter = new InputFilter();

$price = new Input('price');
$price->setValidatorChain($validators);

$url = new Input('url');
$url->setValidatorChain($validators);

$inputFilter->add($price)
            ->add($url);
$inputFilter->setData([
    'price' => 'abc'
]);

$valid = $inputFilter->isValid();
var_dump($valid);
var_dump($inputFilter->getMessages());
echo '<hr>';

echo ceil((microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']) * 1000.0) . ' ms';
