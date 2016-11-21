<?php
namespace Vm\Entity;

class Image
{
    /**
     * @var int|null image id or null
     */
    protected $imageId;

    /**
     * @var int|null collection id to which this image belongs
     */
    protected $collectionId;

    /**
     * @var int display priority
     */
    protected $priority;

    /**
     * @var string original name of the file
     */
    protected $originalName;

    /**
     * @var int file size in bytes
     */
    protected $size;

    /**
     * @var string mime type string
     */
    protected $mimeType;

    /**
     * @var string extension file extension e.g. 'jpg', 'png', 'gif'
     */
    protected $extension;

    /**
     * @var string 40-character checksum (SHA1)
     */
    protected $checksum;

    /**
     * @var int width in pixels
     */
    protected $width;

    /**
     * @var int height in pixels
     */
    protected $height;

    /**
     * @var string aspect ratio one of '4:3', '3:2', '16:9'
     */
    protected $aspect;

    /**
     * @var bool
     */
    protected $isPortrait;

    /**
     * @var \DateTime UTC timestamp
     */
    protected $created;

    /**
     * @var \DateTime UTC timestamp
     */
    protected $modified;

    /**
     * @param int|null $imageId image id or null
     * @return Image
     */
    public function setImageId($imageId)
    {
        if ($imageId === null) {
            $imageId = null;
            return $this;
        }
        $this->imageId = (int) $imageId;
        return $this;
    }

    /**
     * @return int|null image id or null
     */
    public function getImageId()
    {
        return $this->imageId;
    }

    /**
     * @param int|null $collectionId the collection id to which this image belongs
     */
    public function setCollectionId($collectionId)
    {
        if ($collectionId === null) {
            $this->collectionId = null;
            return $this;
        }
        $this->collectionId = (int) $collectionId;
        return $this;
    }

    /**
     * @return int|null collection id or null
     */
    public function getCollectionId()
    {
        return $this->collectionId;
    }

    public function setPriority($priority)
    {
        if ($priority === null) {
            $this->priority = null;
        } else {
            $this->priority = (int) $priority;
        }
        return $this;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param string $originalName the original file name
     * @return Image
     */
    public function setOriginalName($originalName)
    {
        $this->originalName = (string) $originalName;
        return $this;
    }

    /**
     * @return string the original file name
     */
    public function getOriginalName()
    {
        return $this->originalName;
    }

    /**
     * @param int $size file size in bytes
     * @return Image
     */
    public function setSize($size)
    {
        $this->size = (int) $size;
        return $this;
    }

    /**
     * @return int file size in bytes
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param string $mimeType the mime type e.g. 'image/jpeg'
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = (string) $mimeType;
        return $this;
    }

    /**
     * @return string mime type
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set the file extension to be used for this type of image
     * @param string|null $extension the file extension of null if not known, defaults to '.jpg'
     * @return Image
     */
    public function setExtension($extension)
    {
        if ($extension === null) {
            $this->extension = 'jpg';
            return $this;
        }

        if ($extension === 'jpeg') {
            $this->extension = 'jpg';
            return $this;
        }

        $this->extension = (string) $extension;
        return $this;
    }

    /**
     * @return string the file extension
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param string sha1 checksum 40 characters
     */
    public function setChecksum($checksum)
    {
        $this->checksum = (string) $checksum;
        return $this;
    }

    /**
     * @return string checksum as a 40-character SHA1
     */
    public function getChecksum()
    {
        return $this->checksum;
    }

    /**
     * @param int $width width in pixels
     * @return Image
     */
    public function setWidth($width)
    {
        $this->width = (int) $width;
        return $this;
    }

    /**
     * @return int width in pixels
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $height height in pixels
     * @return Image
     */
    public function setHeight($height)
    {
        $this->height = (int) $height;
        return $this;
    }

    /**
     * @return int height in pixels
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param string $aspect aspect ratio one of '4:3', '3:2', '16:9'
     * @return Image
     */
    public function setAspect($aspect)
    {
        $this->aspect = (string) $aspect;
        return $this;
    }

    /**
     * @return string aspect ratio e.g. '4:3', '3:2', '16:9'
     */
    public function getAspect()
    {
        return $this->aspect;
    }

    /**
     * @return Image
     */
    public function setAsLandscape()
    {
        $this->isPortrait = false;
    }

    /**
     * @return Image
     */
    public function setAsPortrait()
    {
        $this->isPortrait = true;
    }

    /**
     * @param bool $isPortrait true or false
     * @return Image
     */
    public function setIsPortrait($isPortrait)
    {
        $this->isPortrait = (bool) $isPortrait;
        return $this;
    }

    /**
     * @return bool true or false
     */
    public function isPortrait()
    {
        return $this->isPortrait;
    }

    public function setCreated(\Datetime $created)
    {
        $this->created = $created;
        return $this;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setModified(\Datetime $modified)
    {
        $this->modified = $modified;
        return $this;
    }

    public function getModified()
    {
        return $this->modified;
    }
}
