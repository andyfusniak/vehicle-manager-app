<?php
namespace Serenity\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Serenity\Entity\Image;
use Serenity\Hydrator\ImageDbHydrator;
use Serenity\Mapper\ImageMapper;

class ImageService
{
    /**
     * @var array application config
     */
    protected $config;

    /**
     * @var ImageMapper
     */
    protected $mapper;

    /**
     * @var ImageDbHydrator
     */
    protected $dbHydrator;

    /**
     * @param array $config application configuration
     */
    public function __construct($config, ImageMapper $mapper, ImageDbHydrator $dbHydrator)
    {
        $this->config = $config;
        $this->mapper = $mapper;
        $this->dbHydrator = $dbHydrator;
    }

    public function aspectRatioFromWidthAndHeight($width, $height)
    {

    }

    /**
     * @param int $collectionId
     * @param array of UploadedFile object
     * @return bool true or false depending on outcome
     */
    public function saveImages($collectionId, $files)
    {
        if ($files === null) {
            throw new \Exception(sprintf(
                '%s received null value for files.  Possibly exceeded PHP post_max_files',
                __METHOD__
            ));
        }
        $valid = true;
        foreach ($files as $file) {
            if (($file instanceof UploadedFile) && ($file->getError() === 0)) {
                $tmpFile = $file->getFileInfo()->__toString();
                $originalName = $file->getClientOriginalName();

                $imagesize = getimagesize($tmpFile);

                //var_dump('IMG_JPEG='.IMG_JPEG);

                // calculate the SHA1 checksum prior to the move and we also need
                // a primary key value back from the mapper to name the file
                // symfony guessExtension returns 'jpeg' not 'jpg' so we inject it into Image class
                // to convert it
                $image = new Image();
                $image->setOriginalName($originalName)
                      ->setCollectionId((int) $collectionId)
                      ->setSize($file->getClientSize())
                      ->setMimeType($file->getMimeType())
                      ->setExtension($file->guessExtension())
                      ->setChecksum(sha1_file($file->getFileInfo()->__toString()))
                      ->setWidth($imagesize[0])
                      ->setHeight($imagesize[1])
                      ->setAspect('4:3')
                      ->setAsLandscape();
                $pk = $this->mapper->insert($image);
                $file->move(
                    $this->config['serenitylesiure']['upload_dir'],
                    (string) $pk . '.' . $image->getExtension()
                );
                if ($valid) {
                    $valid = false;
                }
            } else if (($file instanceof UploadedFile) && ($file->getError() > 0)) {
                //var_dump($file->getError());
                //var_dump($file->getErrorMessage());
                die('File size exceeded');
                return false;
            }
        }
        return $valid;
    }

    /**
     * @param int $collectionId
     * @return array of Image objects
     */
    public function fetchAllByCollectionId($collectionId)
    {
        $imageObjects = [];
        $images = $this->mapper->fetchByCollectionId($collectionId);

        foreach ($images as $data) {
            $object = new Image();
            $imageObjects[] = $this->dbHydrator->hydrate($data, $object);
        }

        return $imageObjects;
    }
}
