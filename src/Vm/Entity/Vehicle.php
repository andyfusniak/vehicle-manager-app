<?php
namespace Vm\Entity;

use Vm\Entity\Collection;

class Vehicle
{
    /**
     * @var array list of valid vehicle types
     */
    private static $validVehicleTypes = [
        'caravans',
        'motorhomes',
        'awningrange',
        'newcaravans'
    ];

    /**
     * @var int vehicle unique id (primary key)
     */
    protected $vehicleId;

    /**
     * @var string vehicle type
     */
    protected $type;

    /**
     * @var bool
     */
    protected $visible;

    /**
     * @var bool sold
     */
    protected $sold;

    /**
     * @var bool
     */
    protected $new;

    /**
     * @var bool
     */
    protected $featured;

    /**
     * @var string slug url for this vehicle
     */
    protected $url;

    /**
     * @var int the price in pounds of this vehicle
     */
    protected $price;

    /**
     * @var string meta keywords for this vehicle page
     */
    protected $metaKeywords;

    /**
     * @var string meta description for this vehicle page
     */
    protected $metaDesc;

    /**
     * @var string page title
     */
    protected $pageTitle;

    /**
     * @var int set of photos to use for this vehicle
     */
    protected $collectionId;

    /**
     * @var string markdown content
     */
    protected $markdown;

    /**
     * @var string cached page html pre-generated from markdown
     */
    protected $pageHtml;

    /**
     * @var array $features array of features for this vehicle
     */
    protected $features = [];

    /**
     * @var Collection|null $collection container object loaded with Image objects
     */
    protected $collection;

    /**
     * @var \DateTime created datetime object
     */
    protected $created;

    /**
     * @var \DateTime last modified datetime object
     */
    protected $modified;

    public function setVehicleId($vehicleId)
    {
        $this->vehicleId = $vehicleId;
        return $this;
    }

    public function getVehicleId()
    {
        return $this->vehicleId;
    }

    public function setType($type)
    {
        if (!in_array($type, self::$validVehicleTypes)) {
            throw new \InvalidArgumentException(sprintf(
                '%s: expects a value of {%s}.  Value of "%s" passed',
                __METHOD__,
                implode(',', self::$validVehicleTypes),
                $type
            ));
        }
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setVisible($visible)
    {
        $this->visible = (bool) $visible;
        return $this;
    }

    public function getVisible()
    {
        return $this->visible;
    }

    public function setSold($sold)
    {
        $this->sold = (bool) $sold;
        return $this;
    }

    public function getSold()
    {
        return $this->sold;
    }

    public function setNew($new)
    {
        $this->new = (bool) $new;
        return $this;
    }

    public function getNew()
    {
        return $this->new;
    }

    public function setFeatured($featured)
    {
        $this->featured = (bool) $featured;
        return $this;
    }

    public function getFeatured()
    {
        return $this->featured;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = (string) $metaKeywords;
        return $this;
    }

    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    public function setMetaDesc($metaDesc)
    {
        $this->metaDesc = (string) $metaDesc;
        return $this;
    }

    public function getMetaDesc()
    {
        return $this->metaDesc;
    }

    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = (string) $pageTitle;
        return $this;
    }

    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    public function setFeatures($features)
    {
        $this->features = $features;
        return $this;
    }

    public function getFeatures()
    {
        return $this->features;
    }

    public function setCollectionId($collectionId)
    {
        $this->collectionId = (int) $collectionId;
        return $this;
    }

    public function getCollectionId()
    {
        return $this->collectionId;
    }

    public function setMarkdown($markdown)
    {
        $this->markdown = (string) $markdown;
        return $this;
    }

    public function getMarkdown()
    {
        return $this->markdown;
    }

    public function setPageHtml($pageHtml)
    {
        $this->pageHtml = (string) $pageHtml;
        return $this;
    }

    public function getPageHtml()
    {
        return $this->pageHtml;
    }

    public function setCollection(Collection $collection)
    {
        $this->collection = $collection;
        return $this;
    }

    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Set the created datetime
     * @param \DateTime the datetime created
     * @return Vehicle
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
     * @return Vehicle
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
}
