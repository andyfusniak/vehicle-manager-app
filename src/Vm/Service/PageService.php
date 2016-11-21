<?php
namespace Vm\Service;

use Vm\Entity\Page;
use Vm\Mapper\PageMapper;
use Vm\Hydrator\PageDbHydrator;
use Vm\Hydrator\PageFormHydrator;

class PageService
{
    /**
     * @var PageMapper
     */
    protected $mapper;

    /**
     * @var PageDbHydator
     */
    protected $dbHydrator;

    /**
     * @var PageFormHydrator
     */
    protected $formHydrator;

    public function __construct(PageMapper $mapper,
                                PageDbHydrator $dbHydrator,
                                PageFormHydrator $formHydrator)
    {
        $this->mapper = $mapper;
        $this->dbHydrator = $dbHydrator;
        $this->formHydrator = $formHydrator;
    }

    /**
     * Add a new page
     *
     * @param array $data the page data
     * @return the new page id
     */
    public function addPage(array $data)
    {
        $page = $this->formHydrator->hydrate($data, new Page());
        return $this->mapper->insert($page);
    }

    public function updatePage(array $data)
    {
        $page = $this->formHydrator->hydrate($data, new Page());
        $dbData = $this->dbHydrator->extract($page);
        unset($dbData['created']);
        unset($dbData['modified']);

        $this->mapper->update($dbData);
    }

    public function fetchAll($orderBy = PageMapper::COLUMN_PRIORITY, $orderDirection = 'ASC')
    {
        $objects = [];
        $pages = $this->mapper->fetchAllAssocArray($orderBy, $orderDirection);

        foreach ($pages as $data) {
            $object = new Page();
            $objects[] = $this->dbHydrator->hydrate($data, $object);
        }

        return $objects;
    }

    public function fetchAllByLayoutPosition($layoutPosition, $orderBy = PageMapper::COLUMN_PRIORITY, $orderDirection = 'ASC')
    {
        $objects = [];
        $pages = $this->mapper->fetchAllByLayoutPositionAssocArray(
            $layoutPosition,
            $orderBy,
            $orderDirection
        );

        foreach ($pages as $data) {
            $object = new Page();
            $objects[] = $this->dbHydrator->hydrate($data, $object);
        }

        return $objects;
    }

    /**
     * @param int $pageId the unique page id
     * @return Page a page object complete with data
     */
    public function fetchPageByPageId($pageId)
    {
        return $this->dbHydrator->hydrate(
            $this->mapper->fetchByPageIdAssocArray($pageId), new Page()
        );
    }

    /**
     * @param string $url the url slug for this page
     * @return Page object
     */
    public function fetchPageByUrl($url)
    {
        return $this->mapper->fetchPageByUrl($url);
    }

    public function fetchUrlAndPageNamesByLayoutPosition($layoutPosition, $orderBy = PageMapper::COLUMN_PRIORITY, $orderDirection = 'ASC')
    {
        return $this->mapper->fetchUrlAndPageNamesByLayoutPositionAssocArray(
            $layoutPosition,
            $orderBy,
            $orderDirection
        );
    }

    public function pageObjectToFormData(Page $page)
    {
        return $this->formHydrator->extract($page);
    }

    /**
     * Check if the url is taken as a whole or in the context of a specific page
     * If $pageId is set to a particular page then the url for that page is not
     * checked.  This is generally used for updating a form
     *
     * @param string $url page url to check
     * @param int $pageId page id context
     * @return bool true or false if the url is in use
     */
    public function isUrlTaken($url, $pageId = null)
    {
        return $this->mapper->isUrlTaken($url, $pageId);
    }

    /**
     * Fetch the markdown only for a given page
     *
     * @param int $pageId the page primary key
     * @return string markdown text
     */
    public function fetchMarkdownOnlyByPageId($pageId)
    {
        return $this->mapper->fetchMarkdownOnlyByPageId((int) $pageId);
    }

    /**
     * Update the markdown only for a given page
     *
     * @param int $pageId the page id to update
     * @param string $markdown the new markdown text
     */
    public function updateMarkdownOnly($pageId, $markdown)
    {
        return $this->mapper->updateMarkdownOnly($pageId, $markdown);
    }

    public function updatePageOrder($data)
    {
        if (isset($data['page'])) {
            $this->mapper->updatePageOrder($data['page']);
        }
    }

    /**
     * @param int $pageId the page to delete
     */
    public function deletePage($pageId)
    {
        $this->mapper->delete((int) $pageId);
    }

    public function selectBoxLayoutPositions()
    {
        return Page::$layoutPositionTitles;
    }
}
