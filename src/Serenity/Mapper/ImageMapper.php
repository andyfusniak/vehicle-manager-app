<?php
namespace Serenity\Mapper;

use Serenity\Entity\Image;
use Serenity\Hydrator\ImageDbHydrator;

class ImageMapper
{
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
            'INSERT INTO images (image_id, original_name, size, mime_type, extension, checksum, width, height, aspect, is_portrait, created, modified) VALUES (null, :original_name, :size, :mime_type, :extension, :checksum, :width, :height, :aspect, :is_portrait, NOW(), NOW())'
        );
        unset($data['image_id']);
        $statement->bindValue(':original_name', $data['original_name'], \PDO::PARAM_STR);
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
}
