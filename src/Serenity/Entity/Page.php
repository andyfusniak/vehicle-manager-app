<?php
namespace Serenity\Entity;

class Page
{
    /**
     * @var int|null page id
     */
    protected $pageId;

    /**
     * @var string the part url of this page
     */
    protected $url;

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
