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
     * @var array
     */
    protected $defaultSizes;

    /**
     * @param array $config application configuration
     */
    public function __construct($config, ImageMapper $mapper, ImageDbHydrator $dbHydrator)
    {
        $this->config = $config;
        $this->mapper = $mapper;
        $this->dbHydrator = $dbHydrator;
        if (isset($config['serenityleisure']['web_image_sizes']) &&
            is_array($config['serenityleisure']['web_image_sizes'])) {
            $this->defaultSizes = $config['serenityleisure']['web_image_sizes'];
            var_dump($this->defaultSizes);
        }
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
                $image->setImageId($pk);
                $file->move(
                    $this->config['serenityleisure']['upload_dir'],
                    (string) $pk . '.' . $image->getExtension()
                );

                // generate the web images
                $this->generateImages($image, $this->defaultSizes);

                if ($valid) {
                    $valid = false;
                }
            } else if (($file instanceof UploadedFile) && ($file->getError() > 0)) {
                var_dump($files);
                var_dump($file->getError());
                var_dump($file->getErrorMessage());
                die('File size exceeded');
                return false;
            }
        }
        return $valid;
    }

    public function generateImages(Image $image, $sizes = [250])
    {
        $uploadDir = $this->config['serenityleisure']['upload_dir'];
        $webDir = $this->config['serenityleisure']['web_dir'];

        if ((!isset($uploadDir)) || (!is_string($uploadDir))) {
            throw new \Exception(sprintf(
                '%s $config[\'serenityleisure\'][\'upload_dir\'] not set or not string value',
                __METHOD__
            ));
        }

        if ((!isset($webDir)) || (!is_string($webDir))) {
            throw new \Exception(sprintf(
                '%s $config[\'serenityleisure\'][\'web_dir\'] not set or not string value',
                __METHOD__
            ));
        }

        $imageId = (string) $image->getImageId();
        $extension = $image->getExtension();

        // TODO dont need to recreate the master image for each iteration
        // just needs to be done once outside the loop
        foreach ($sizes as $size) {
            $masterImage = $uploadDir . '/' . $imageId . '.' . $extension;
            $gdMaster = imagecreatefromjpeg($masterImage);
            $widthMaster  = imagesx($gdMaster);
            $heightMaster = imagesy($gdMaster);
            if ($widthMaster < $heightMaster) {
                throw new \Exception(sprintf(
                    '%s does not support portrait images',
                    __METHOD__
                ));
            }
            $inverseAspectRatio = floatval($heightMaster) / floatval($widthMaster);
            $targetY = (float) $size * $inverseAspectRatio;

            $gdTarget = imagecreatetruecolor($size, $targetY);
            imagecopyresampled($gdTarget, $gdMaster, 0, 0, 0, 0, $size, $targetY, $widthMaster, $heightMaster);
            $filePath = $webDir
                      . '/' . (string) $image->getImageId()
                      . '_' . $size . '.' . (string) $image->getExtension();
            imagejpeg($gdTarget, $filePath, 100);
            imagedestroy($gdMaster);
            imagedestroy($gdTarget);
        }
    }

    public function destroyImages($imageId)
    {
        $uploadDir = $this->config['serenityleisure']['upload_dir'];
        $webDir = $this->config['serenityleisure']['web_dir'];

        $uploadDir = $this->config['serenityleisure']['upload_dir'];
        $webDir = $this->config['serenityleisure']['web_dir'];

        if ((!isset($uploadDir)) || (!is_string($uploadDir))) {
            throw new \Exception(sprintf(
                '%s $config[\'serenityleisure\'][\'upload_dir\'] not set or not string value',
                __METHOD__
            ));
        }

        if ((!isset($webDir)) || (!is_string($webDir))) {
            throw new \Exception(sprintf(
                '%s $config[\'serenityleisure\'][\'web_dir\'] not set or not string value',
                __METHOD__
            ));
        }

        unlink($uploadDir . '/' . $imageId . '.jpg');
        array_map('unlink', glob($webDir . '/' . $imageId . '_*.jpg'));
    }

    /**
     * @param int $collectionId
     * @return array of Image objects
     */
    public function fetchAllByCollectionId($collectionId, $orderBy = [])
    {
        $imageObjects = [];
        $images = $this->mapper->fetchByCollectionId($collectionId, $orderBy);

        foreach ($images as $data) {
            $object = new Image();
            $imageObjects[] = $this->dbHydrator->hydrate($data, $object);
        }

        return $imageObjects;
    }

    public function updatePhotoOrder($data)
    {
        if (isset($data['photo'])) {
            $this->mapper->updatePhotoOrder($data['photo']);
        }
    }

    public function deletePhotoOrder($data)
    {


        // format is $data['delete'] = 'photo-123'
        if (isset($data['delete'])) {
            $parts = split('-', $data['delete']);
            $imageId = end($parts);

            $this->destroyImages($imageId);
            $this->mapper->deletePhotoOrder($imageId);
        }
    }
}
