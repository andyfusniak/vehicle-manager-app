<?php
namespace Serenity\Hydrator;

use Nitrogen\Hydrator\AbstractDbHydrator;
use Serenity\Entity\Image;

class ImageDbHydrator extends AbstractDbHydrator
{
    public function extract($image)
    {
        if (!$image instanceof Image) {
            throw new \InvalidArgumentException(sprintf(
                '%s: expects an instance of Image; received "%s"',
                __METHOD__,
                (is_object($image) ? get_class($image) : gettype($image))
            ));
        }

        return array(
            'image_id'      => $image->getImageId(),
            'collection_id' => $image->getCollectionId(),
            'priority'      => $image->getPriority(),
            'original_name' => $image->getOriginalName(),
            'size'          => $image->getSize(),
            'mime_type'     => $image->getMimeType(),
            'extension'     => $image->getExtension(),
            'checksum'      => $image->getChecksum(),
            'width'         => $image->getWidth(),
            'height'        => $image->getHeight(),
            'aspect'        => $image->getAspect(),
            'is_portrait'   => $image->isPortrait(),
            'created'       => $image->getCreated(),
            'modified'      => $image->getModified()
        );
    }

    public function hydrate(array $data, $image)
    {
        $image->setImageId((int) $data['image_id'])
              ->setCollectionId($data['collection_id'])
              ->setPriority($data['priority'])
              ->setOriginalName($data['original_name'])
              ->setSize((int) $data['size'])
              ->setMimeType($data['mime_type'])
              ->setExtension($data['extension'])
              ->setChecksum($data['checksum'])
              ->setWidth((int) $data['width'])
              ->setHeight((int) $data['height'])
              ->setAspect($data['aspect'])
              ->setIsPortrait(($data['is_portrait'] === '1') ? true : false)
              ->setCreated($this->mysqlTimeStampToDateTime($data['created']))
              ->setModified($this->mysqlTimeStampToDateTime($data['modified']));
        return $image;
    }
}
