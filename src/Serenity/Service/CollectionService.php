<?php
namespace Serenity\Service;

use Serenity\Entity\Collection;
use Serenity\Hydrator\CollectionFormHydrator;
use Serenity\Mapper\CollectionMapper;

class CollectionService
{
    /**
     * @var CollectionMapper
     */
    protected $mapper;

    /**
     * @var CollectionFormHydrator
     */
    protected $formHydrator;

    public function __construct(CollectionMapper $mapper,
                                CollectionFormHydrator $formHydrator)
    {
        $this->mapper = $mapper;
        $this->formHydrator = $formHydrator;
    }

    /**
     * Add a new collection to persistent storage
     *
     * @param array $collection the collection form data
     * @return int the new collection id
     */
    public function addCollection(array $data)
    {
        $collection = new Collection();
        return $this->mapper->insert($this->formHydrator->hydrate($data, $collection));
    }

    /**
     * @param string $tagname tagname to check for
     * @return bool returns true or false
     */
    public function isTagnameTaken($tagname)
    {
        return $this->mapper->isTagnameTaken($tagname);
    }

    /**
     * Fetch a list of name value pairs for select box options
     * @return array
     */
    public function collectionsValueOptions()
    {
        $collections = $this->mapper->fetchAll();
        $valueOptions = [];
        foreach ($collections as $collection) {
            $valueOptions[$collection['collection_id']] = $collection['name']
                . ' (' . $collection['tagname'] . ')';
        }
        return $valueOptions;
    }
}
