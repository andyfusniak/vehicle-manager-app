<?php
namespace Serenity\Mapper;

use Serenity\Entity\Image;
use Serenity\Hydrator\ImageDbHydrator;

class ImageMapper
{
    const COLUMN_COLLECTION_ID = 'collection_id';
    const COLUMN_PRIORITY      = 'priority';

    /**
     * @var array
     */
    private static $validSortableColumns = [
        self::COLUMN_COLLECTION_ID,
        self::COLUMN_PRIORITY
    ];

    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * @var ImageDbHydrator
     */
    protected $hydrator;

    /**
     * @param \PDO $pdo the database adapter
     * @param ImageDbHydrator $hydrator the hydrator object
     */
    public function __construct(\PDO $pdo, ImageDbHydrator $hydrator)
    {
        $this->pdo = $pdo;
        $this->hydrator = $hydrator;
    }

    /**
     * Create a new image row in the database
     *
     * @param Image $image the image object
     * @return int the last insert id from the db
     */
    public function insert(Image $image)
    {
        $this->pdo->beginTransaction();
        $data = $this->hydrator->extract($image);

        // if the priority is null use the next available one
        // by inspecting the database
        if ($image->getPriority() === null) {
            $statement1 = $this->pdo->prepare('
                SELECT MAX(priority) + 1 AS next
                FROM images
                WHERE collection_id = :collection_id
            ');
            $statement1->bindValue(':collection_id', $data['collection_id'], \PDO::PARAM_INT);
            $statement1->execute();
            $row = $statement1->fetch(\PDO::FETCH_ASSOC);
            if (is_array($row)) {
                $next = (int) $row['next'];
                if ($next === null) {
                    $next = 1;
                }
            } else {
                $next = 1;
            }
        } else {
            $next = $image->getPriority();
        }

        $statement2 = $this->pdo->prepare('
            INSERT INTO images (
                image_id, collection_id, priority, original_name, size,
                mime_type, extension, checksum, width, height,
                aspect, is_portrait, created, modified
            ) VALUES (
                null, :collection_id, :priority, :original_name, :size,
                :mime_type, :extension, :checksum, :width, :height,
                :aspect, :is_portrait, NOW(), NOW()
            )
        ');
        unset($data['image_id']);
        $statement2->bindValue(':original_name', $data['original_name'], \PDO::PARAM_STR);
        $statement2->bindValue(':collection_id', $data['collection_id'], \PDO::PARAM_INT);
        $statement2->bindValue(':priority', $next, \PDO::PARAM_INT);
        $statement2->bindValue(':size', $data['size'], \PDO::PARAM_INT);
        $statement2->bindValue(':mime_type', $data['mime_type'], \PDO::PARAM_STR);
        $statement2->bindValue(':extension', $data['extension'], \PDO::PARAM_STR);
        $statement2->bindValue(':checksum', $data['checksum'], \PDO::PARAM_STR);
        $statement2->bindValue(':width', $data['width'], \PDO::PARAM_INT);
        $statement2->bindValue(':height', $data['height'], \PDO::PARAM_INT);
        $statement2->bindValue(':aspect', $data['aspect'], \PDO::PARAM_STR);
        $statement2->bindValue(':is_portrait', $data['is_portrait'], \PDO::PARAM_BOOL);
        $statement2->execute();
        $lastInsertId = $this->pdo->lastInsertId();

        $statement3 = $this->pdo->prepare('
            UPDATE collections
            SET modified = NOW()
            WHERE collection_id = :collection_id
        ');
        $statement3->bindValue(':collection_id', $data['collection_id'], \PDO::PARAM_INT);
        $statement3->execute();

        $this->pdo->commit();

        return $lastInsertId;
    }

    public function fetchByCollectionId($collectionId, $orderBy = [], $orderDirection = 'ASC')
    {
        // check the values for the order by parameters as these will be injected
        // into the SQL statment directly and not using bindValue
        foreach ($orderBy as $ob) {
            if (!in_array($ob, self::$validSortableColumns)) {
                throw new \Exception(sprintf(
                    '%s invalid column passed for orderBy "%s"',
                    __METHOD__,
                    $ob
                ));
            }
        }
        $sql = 'SELECT * FROM images WHERE collection_id = :collection_id';
        if (!empty($orderBy)) {
            $sql .= ' ORDER BY ' . implode(', ', $orderBy)  . (($orderDirection === 'DESC') ? ' DESC' : ' ASC');
        }

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':collection_id', (int) $collectionId, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function updatePhotoOrder(array $data)
    {
        $this->pdo->beginTransaction();

        $priority = 1;
        foreach($data as $value) {
            $statement = $this->pdo->prepare(
                'UPDATE images SET priority = :priority WHERE image_id = :image_id'
            );
            $statement->bindValue(':priority', $priority++, \PDO::PARAM_INT);
            $statement->bindValue(':image_id', (int) $value, \PDO::PARAM_INT);
            $statement->execute();
        }

        $this->pdo->commit();
    }

    public function deletePhotoOrder($imageId)
    {
        $statement = $this->pdo->prepare(
            'DELETE FROM images WHERE image_id = :image_id'
        );
        $statement->bindValue(':image_id', (int) $imageId, \PDO::PARAM_INT);
        $statement->execute();
    }
}
