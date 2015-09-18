<?php
namespace Serenity\Entity;

class Vehicle
{
    /**
     * @var array list of valid vehicle types
     */
    private static $validVehicleTypes = array(
        'caravans',
        'motorhomes',
        'awningrange',
        'accessories',
        'cars'
    );

    /**
     * @var int vehicle unique id (primary key)
     */
    protected $vehicleId;

    /**
     * @var string vehicle type
     */
    protected $type;

    /**
     * @var bool visible
     */
    protected $visible;

    /**
     * @var bool sold
     */
    protected $sold;

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
     * @var string markdown content
     */
    protected $markdown;

    /**
     * @var string cached page html pre-generated from markdown
     */
    protected $pageHtml;

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
        $this->metaKeywords = $metaKeywords;
        return $this;
    }

    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    public function setMetaDesc($metaDesc)
    {
        $this->metaDesc = $metaDesc;
        return $this;
    }

    public function getMetaDesc()
    {
        return $this->metaDesc;
    }

    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;
        return $this;
    }

    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    public function setMarkdown($markdown)
    {
        $this->markdown = $markdown;
        return $this;
    }

    public function getMarkdown()
    {
        return $this->markdown;
    }

    public function setPageHtml($pageHtml)
    {
        $this->pageHtml = $pageHtml;
        return $this;
    }

    public function getPageHtml()
    {
        return $this->pageHtml;
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
