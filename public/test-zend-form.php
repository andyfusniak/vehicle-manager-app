<?php
chdir(dirname(__DIR__));

// Setup autoloading
require_once './vendor/autoload.php';

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Form\View\Helper\FormInput;


$username = new Element\Text('username');
$username->setAttributes(array(
    'class' => 'username',
    'size'  => '30',
))->setValue('johndoe');

$form = new Form();
$form->add($username);


$formElementHelper = new FormInput();

var_dump($formElementHelper->render($username));
