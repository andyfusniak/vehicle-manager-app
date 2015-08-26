<?php
require_once 'config.php';
require_once 'src/Serenity/Entity/Admin.php';
require_once 'src/Serenity/Mapper/AdminMapper.php';
require_once 'src/Serenity/Hydrator/AdminDbHydrator.php';

//print_r(PDO::getAvailableDrivers());

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

$adminObject = new Serenity\Entity\Admin();
$adminObject->setAdminId(null)
            ->setUsername('joe')
            ->setCreated($serverDt)
            ->setModified($serverDt);

$adminHydrator = new Serenity\Hydrator\AdminDbHydrator();
$adminMapper = new Serenity\Mapper\AdminMapper($pdo, $adminHydrator);
$adminMapper->insert($adminObject);
