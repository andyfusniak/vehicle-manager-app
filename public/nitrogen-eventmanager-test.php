<?php
chdir(dirname(__DIR__));

// Setup autoloading
require_once './vendor/autoload.php';

use Nitrogen\EventManager\EventManager;
use Nitrogen\EventManager\Event;

$eventManager = new EventManager();

$eventManager->attach('drums', function ($event) {
    echo 'Boombom tissk';
    //var_dump($e);
});

$eventManager->attach('guitar', function ($event) {
    echo 'Riffff';
});
$eventManager->attach('guitar', function ($event) {
    echo 'Waam';
});
$eventManager->attach('guitar', function ($event) {
    echo 'Whoooo';
});

$event = new Event();
$eventManager->trigger('guitar', $event);

