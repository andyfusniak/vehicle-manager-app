<?php
chdir(dirname(__DIR__));

// Setup autoloading
require_once './vendor/autoload.php';
require_once 'config.php';

//print_r(PDO::getAvailableDrivers());

use Serenity\Entity\Admin;
use Serenity\Entity\Vehicle;

try {
    $pdo = new PDO(
        'mysql:host=' . $config['db']['hostname'] . ';dbname=' . $config['db']['database'],
        $config['db']['username'],
        $config['db']['password']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    var_dump($e->getMessage());
}

$serverTimeZone = new \DateTimeZone($config['system']['timezones']['server']);
$serverDt = new \DateTime('now', $serverTimeZone);

//$adminObject = new Admin();
//$adminObject->setAdminId(null)
//            ->setUsername('joe')
//            ->setPasswd('hashcode')
//            ->setCreated($serverDt)
//            ->setModified($serverDt);

//$adminDbHydrator = new Serenity\Hydrator\AdminDbHydrator();
//$adminMapper = new Serenity\Mapper\AdminMapper($pdo, $adminDbHydrator);
//$i = $adminMapper->insert($adminObject);
//var_dump($i);

// vehicle test

$vehicle = new Vehicle();
$vehicle->setVehicleId(null)
        ->setType('caravans')
        ->setVisible(true)
        ->setSold(false)
        ->setUrl('my-new-car')
        ->setPrice(2795)
        ->setMetaKeywords('a,b,c,d,e,f')
        ->setMetaDesc('A wonderful caravan for sale')
        ->setPageTitle('ABC Caravan Model XYZ')
        ->setMarkdown('# My caravan etc etc')
        ->setPageHtml('<h1>My caravan etc etc</h1>')
        ->setCreated($serverDt)
        ->setModified($serverDt);

var_dump($vehicle);

$vehicleDbHydrator = new Serenity\Hydrator\VehicleDbHydrator();

$vehicleDbHydrator->extract($vehicle);
$vehicleMapper = new Serenity\Mapper\VehicleMapper($pdo, $vehicleDbHydrator);

$i = $vehicleMapper->insert($vehicle);
var_dump($i);
//var_dump($vehicle);
