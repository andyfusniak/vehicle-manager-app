<?php
namespace Vm\Mapper;

use Vm\Entity\Admin;
use Vm\Hydrator\AdminDbHydrator;

class AdminMapper
{
    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * @var AdminDbHydrator
     */
    protected $dbHydrator;

    /**
     * @param \PDO $pdo the database adapater
     * @param AdminDbHydrator $hydrator database object hydrator and extractor
     */
    public function __construct(\PDO $pdo, AdminDbHydrator $dbHydrator)
    {
        $this->pdo = $pdo;
        $this->dbHydrator = $dbHydrator;
    }

    /**
     * @param Admin $admin the admin object to persist
     * @return int the last insert id from the db
     */
    public function insert(Admin $admin)
    {
        $data = $this->dbHydrator->extract($admin);
        unset($data['admin_id']);
        unset($data['created']);
        unset($data['modified']);

        $statement = $this->pdo->prepare(
            'INSERT INTO admins (admin_id, username, passwd, created, modified) VALUES (null, :username, :passwd, NOW(), NOW())'
        );
        $statement->bindValue(':username', $data['username'], \PDO::PARAM_STR);
        $statement->bindValue(
            ':passwd',
            password_hash($data['passwd'], PASSWORD_BCRYPT),
            \PDO::PARAM_STR
        );
        $statement->execute();
        return $this->pdo->lastInsertId();
    }

    public function fetchAllAssoc()
    {
        $stmt = $this->pdo->prepare(
            'SELECT admin_id, username, created, modified FROM admins'
        );
        $stmt->setFetchMode(\PDO::FETCH_CLASS);
        $obj = $stmt->execute();
        return $obj;
    }

    /**
     * @param string $username
     * @return Admin|null null if the admin could not be found
     */
    public function fetchByUsername($username)
    {
        $statement = $this->pdo->prepare(
            'SELECT * FROM admins WHERE username = :username'
        );
        $statement->bindValue(':username', $username, \PDO::PARAM_STR);
        $statement->execute();
        $row = $statement->fetch(\PDO::FETCH_ASSOC);
        if ($row === false) {
            return null;
        }
        $adminObj = new Admin();
        return $this->dbHydrator->hydrate($row, $adminObj);
    }
}
