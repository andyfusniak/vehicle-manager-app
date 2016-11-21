<?php
namespace Vm\Entity;

class Page
{
    const LAYOUT_POSITION_TOP    = 'top';
    const LAYOUT_POSITION_MAIN   = 'main';
    const LAYOUT_POSITION_FOOTER = 'footer';

    /**
     * @var array list of valid layout positions
     */
    public static $validLayoutPositions = [
        self::LAYOUT_POSITION_TOP,
        self::LAYOUT_POSITION_MAIN,
        self::LAYOUT_POSITION_FOOTER
    ];

    public static $layoutPositionTitles = [
        self::LAYOUT_POSITION_TOP    => 'Top Nav Bar',
        self::LAYOUT_POSITION_MAIN   => 'Main/Central Nav Bar',
        self::LAYOUT_POSITION_FOOTER => 'Footer Link'
    ];

    /**
     * @var int|null page id
     */
    protected $pageId;

    /**
     * @var int priority
     */
    protected $priority;

    /**
     * @var string layout position for rendering
     */
    protected $layoutPosition;

    /**
     * @var string the part url of this page
     */
    protected $url;

    /**
     * @var string page name for editor managing
     */
    protected $name;

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

    /**
     * @param int|null $pageId
     * @return Page
     */
    public function setPageId($pageId)
    {
        if ($pageId === null) {
            $this->pageId = null;
            return $this;
        }
        $this->pageId = (int) $pageId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPageId()
    {
        return $this->pageId;
    }

    /**
     * @param int $priority display priority relative to the layout position group
     * @return Page
     */
    public function setPriority($priority)
    {
        $this->priority = (int) $priority;
        return $this;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function setLayoutPosition($layoutPosition)
    {
        if (!in_array($layoutPosition, self::$validLayoutPositions)) {
            throw new \InvalidArgumentException(sprintf(
                '%s: expects a value of {%s}.  Value of "%s" passed',
                __METHOD__,
                implode(',', self::$validLayoutPositions),
                $layoutPosition
            ));
        }
        $this->layoutPosition = $layoutPosition;
        return $this;
    }

    public function getLayoutPosition()
    {
        return $this->layoutPosition;
    }

    public function setName($name)
    {
        $this->name = (string) $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setUrl($url)
    {
        $this->url = (string) $url;
        return $this;
    }

    public function getUrl()
    {
        return $this->url;
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
