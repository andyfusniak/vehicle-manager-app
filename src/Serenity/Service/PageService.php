<?php
namespace Serenity\Service;

use Serenity\Entity\Page;
use Serenity\Mapper\PageMapper;
use Serenity\Hydrator\PageDbHydrator;

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

    public function __construct(PageMapper $mapper,
                                PageDbHydrator $dbHydrator)
    {
        $this->mapper = $mapper;
        $this->dbHydrator = $dbHydrator;
    }

    public function fetchAll()
    {
        $objects = [];
        $pages = $this->mapper->fetchAllAssocArray();

        foreach ($pages as $data) {
            $object = new Page();
            $objects[] = $this->dbHydrator->hydrate($data, $object);
        }

        return $objects;
    }
}
