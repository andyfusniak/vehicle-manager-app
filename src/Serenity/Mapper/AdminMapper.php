<?php
namespace Serenity\Mapper;

use Serenity\Entity\Admin;
use Serenity\Hydrator\AdminDbHydrator;

class AdminMapper
{
    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * @var AdminDbHydrator
     */
    protected $hydrator;

    /**
     * @param \PDO $pdo the database adapater
     * @param AdminDbHydrator $hydrator database object hydrator and extractor
     */
    public function __construct(\PDO $pdo, AdminDbHydrator $hydrator)
    {
        $this->pdo = $pdo;
        $this->hydrator = $hydrator;
    }

    /**
     * @param Admin $admin the admin object to persist
     * @return int the last insert id from the db
     */
    public function insert($admin)
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO admins (admin_id, username, passwd, created, modified) VALUES (null, :username, :passwd, NOW(), NOW())'
        );

        $data = $this->hydrator->extract($admin);
        unset($data['admin_id']);
        unset($data['created']);
        unset($data['modified']);

        $stmt->execute($data);
        return $this->pdo->lastInsertId();
    }

    public function fetchAll()
    {
        $stmt = $this->pdo->prepare(
            'SELECT admin_id, username, created, modified FROM admins'
        );
        $stmt->setFetchMode(\PDO::FETCH_CLASS);
        $obj = $stmt->execute();
        return $obj;
    }
}
