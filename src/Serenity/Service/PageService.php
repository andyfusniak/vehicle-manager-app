<?php
namespace Serenity\Service;

use Serenity\Entity\Page;
use Serenity\Mapper\PageMapper;
use Serenity\Hydrator\PageDbHydrator;
use Serenity\Hydrator\PageFormHydrator;

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

    /**
     * @param int $pageId the unique page id
     * @return Page a page object complete with data
     */
    public function fetchPageByPageId($pageId)
    {
        $page = new Page();
        return $this->dbHydrator->hydrate(
            $this->mapper->fetchByPageIdAssocArray($pageId), $page
        );
    }


    public function fetchUrlAndPageNames()
    {
        return $this->mapper->fetchUrlAndPageNames();
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
}
