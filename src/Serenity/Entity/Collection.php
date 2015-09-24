<?php
namespace Serenity\Entity;

use Serenity\Entity\Image;

class Collection
{
    /**
     * @var int|null unique id (primary key)
     */
    protected $collectionId;

    /**
     * @var string the tagname for this collection
     */
    protected $tagname;

    /**
     * @var string utf-8 encoded name
     */
    protected $name;

    /**
     * @var \DateTime|null
     */
    protected $created;

    /**
     * @var \DateTime|null
     */
    protected $modified;

    /**
     * @var null|array of Image objects
     */
    protected $images;

    /**
     * @param int|null the primary key
     * @return Collection
     */
    public function setCollectionId($collectionId)
    {
        if ($collectionId === null) {
            $this->collectionId = null;
        }
        $this->collectionId = (int) $collectionId;
        return $this;
    }

    /**
     * @return int the primary key
     */
    public function getCollectionId()
    {
        return $this->collectionId;
    }

    /**
     * @param string $tagname the unique tagname for this collection
     * @return Collection
     */
    public function setTagname($tagname)
    {
        $this->tagname = (string) $tagname;
        return $this;
    }

    /**
     * @return string the unqiue tagname for this collection
     */
    public function getTagname()
    {
        return $this->tagname;
    }

    /**
     * Set the name for this collection
     *
     * @param string $name utf-8 encoded name
     * @return Collection
     */
    public function setName($name)
    {
        $this->name = (string) $name;
        return $this;
    }

    /**
     * Get the name of this collection
     *
     * @return string utf-8 encoded name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the created datetime
     * @param \DateTime the datetime created
     * @return Admin
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * Get the create datetime object
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set the modified datetime
     * @param DateTime the modified datetime object
     * @return Admin
     */
    public function setModified(\DateTime $modified)
    {
        $this->modified = $modified;
        return $this;
    }

    /**
     * Get the last modified datetime object
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param Image $image object
     * @return Collection
     */
    public function addImage(Image $image)
    {
        $this->images[] = $image;
        return $this;
    }

    /**
     * @param array of Image objects
     * @return Collection
     */
    public function setImages(array $images)
    {
        $this->images = $images;
        return $this;
    }

    /**
     * @return array of image objects
     */
    public function getImages()
    {
        return $this->images;
    }
}
