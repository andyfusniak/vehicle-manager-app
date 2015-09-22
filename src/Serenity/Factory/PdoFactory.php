<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

class PdoFactory implements FactoryInterface
{
    /**
     * Create a PDO object
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return \PDO
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        try {
            $pdo = new \PDO(
                'mysql:host=' . $config['db']['hostname'] . ';dbname=' . $config['db']['database'],
                $config['db']['username'],
                $config['db']['password']
            );
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (\PDOException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
