<?php
namespace Serenity\Mapper;

use Serenity\Entity\Collection;
use Serenity\Hydrator\CollectionDbHydrator;

class CollectionMapper
{
    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * @var CollectionDbHydrator
     */
    protected $hydrator;

    /**
     * @param \PDO $pdo the database pdo object
     * @param CollectionDbHydrator $hydrator the db hydrator object
     */
    public function __construct(\PDO $pdo, CollectionDbHydrator $hydrator)
    {
        $this->pdo = $pdo;
        $this->hydrator = $hydrator;
    }

    /**
     * Create a new collection row in the database
     *
     * @param Collection $collection a collection object to persist
     * @return int the last insert id from the db
     */
    public function insert(Collection $collection)
    {
        $data = $this->hydrator->extract($collection);
        $statement = $this->pdo->prepare(
            'INSERT INTO collections (collection_id, tagname, name, created, modified) VALUES (null, :tagname, :name, NOW(), NOW())'
        );
        unset($data['collection_id']);
        unset($data['created']);
        unset($data['modified']);
        $statement->bindValue(':tagname', $data['tagname'], \PDO::PARAM_STR);
        $statement->bindValue(':name', $data['name'], \PDO::PARAM_STR);
        $statement->execute();
        return $this->pdo->lastInsertId();
    }

    /**
     * Is the tagname already in use
     *
     * @param string $tagname the tagname to check for
     * @param
     */
    public function isTagnameTaken($tagname)
    {
        $statement = $this->pdo->prepare(
            'SELECT tagname FROM collections WHERE tagname = :tagname'
        );
        $statement->bindValue(':tagname', (string) $tagname, \PDO::PARAM_STR);
        $statement->execute();
        if (is_array($statement->fetch(\PDO::FETCH_ASSOC))) {
            return true;
        }
        return false;
    }

    /**
     */
    public function fetchAll($orderBy = 'name', $orderDirection = 'ASC')
    {
        $statement = $this->pdo->prepare(
            'SELECT collection_id, tagname, name, created, modified FROM collections ORDER BY :order_by :order_direction'
        );
        $statement->bindValue(':order_by', $orderBy, \PDO::PARAM_STR);
        $statement->bindValue(':order_direction', ($orderDirection === 'DESC') ? 'DESC' : 'ASC', \PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll();
    }

    /**
     */
    public function collectionPhotoCount()
    {
        $statement = $this->pdo->prepare('
            SELECT DISTINCT c.collection_id, COUNT(i.collection_id) AS num_photos
            FROM collections AS c
            LEFT JOIN images AS i
                ON c.collection_id = i.collection_id
            GROUP BY i.collection_id
        ');
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}
