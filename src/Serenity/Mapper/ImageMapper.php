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
        $data = $this->hydrator->extract($image);
        $statement = $this->pdo->prepare(
            'INSERT INTO images (image_id, collection_id, original_name, size, mime_type, extension, checksum, width, height, aspect, is_portrait, created, modified) VALUES (null, :collection_id, :original_name, :size, :mime_type, :extension, :checksum, :width, :height, :aspect, :is_portrait, NOW(), NOW())'
        );
        unset($data['image_id']);
        $statement->bindValue(':original_name', $data['original_name'], \PDO::PARAM_STR);
        $statement->bindValue(':collection_id', $data['collection_id'], \PDO::PARAM_INT);
        $statement->bindValue(':size', $data['size'], \PDO::PARAM_INT);
        $statement->bindValue(':mime_type', $data['mime_type'], \PDO::PARAM_STR);
        $statement->bindValue(':extension', $data['extension'], \PDO::PARAM_STR);
        $statement->bindValue(':checksum', $data['checksum'], \PDO::PARAM_STR);
        $statement->bindValue(':width', $data['width'], \PDO::PARAM_INT);
        $statement->bindValue(':height', $data['height'], \PDO::PARAM_INT);
        $statement->bindValue(':aspect', $data['aspect'], \PDO::PARAM_STR);
        $statement->bindValue(':is_portrait', $data['is_portrait'], \PDO::PARAM_BOOL);
        $statement->execute();
        return $this->pdo->lastInsertId();
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
