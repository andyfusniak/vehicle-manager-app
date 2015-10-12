<?php
namespace Serenity\Mapper;

use Serenity\Entity\Collection;
use Serenity\Hydrator\CollectionDbHydrator;

class CollectionMapper
{
    const COLUMN_COLLECTION_ID = 'collection_id';
    const COLUMN_TAGNAME       = 'tagname';
    const COLUMN_NAME          = 'name';
    const COLUMN_CREATED       = 'created';
    const COLUMN_MODIFIED      = 'updated';

    protected static $validSortableColumns = [
        self::COLUMN_COLLECTION_ID,
        self::COLUMN_TAGNAME,
        self::COLUMN_NAME,
        self::COLUMN_CREATED,
        self::COLUMN_MODIFIED
    ];

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
        if (!in_array($orderBy, self::$validSortableColumns)) {
            throw new \Exception(sprintf(
                '%s invalid column passed for orderBy "%s"',
                __METHOD__,
                $orderBy
            ));
        }

        $sql = 'SELECT collection_id, tagname, name, created, modified FROM collections';
        if (!empty($orderBy)) {
            $sql .= ' ORDER BY ' . $orderBy . (($orderDirection === 'DESC') ? ' DESC' : ' ASC');
        }

        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchCollection($collectionId)
    {
        $statement = $this->pdo->prepare(
            'SELECT * FROM collections WHERE collection_id = :collection_id'
        );
        $statement->bindValue(':collection_id', (int) $collectionId, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     */
    public function collectionPhotoCount()
    {
        $statement = $this->pdo->prepare('
            SELECT DISTINCT C.collection_id, COUNT(I.collection_id) AS num_photos
            FROM collections AS C
            LEFT JOIN images AS I
                ON C.collection_id = I.collection_id
            GROUP BY C.collection_id
        ');
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $collectionId the collection to delete
     */
    public function delete($collectionId)
    {
        $statement = $this->pdo->prepare('
            DELETE FROM collections
            WHERE collection_id = :collection_id
        ');
        $statement->bindValue(':collection_id', $collectionId, \PDO::PARAM_INT);
        $statement->execute();
    }
}
