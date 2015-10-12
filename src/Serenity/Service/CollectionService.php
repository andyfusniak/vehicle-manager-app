<?php
namespace Serenity\Service;

use Serenity\Entity\Collection;
use Serenity\Hydrator\CollectionDbHydrator;
use Serenity\Hydrator\CollectionFormHydrator;
use Serenity\Mapper\CollectionMapper;
use Serenity\Service\ImageService;

class CollectionService
{
    /**
     * @var CollectionMapper
     */
    protected $mapper;

    /**
     * @var ImageService
     */
    protected $imageService;

    /**
     * @var CollectionFormHydrator
     */
    protected $formHydrator;

    /**
     * @var CollectionDbHydrator
     */
    protected $dbHydrator;

    /**
     * @param CollectionMapper $mapper
     * @param CollectionFormHydrator $formHydrator
     * @param CollectionDbHydrator $dbHydrator
     */
    public function __construct(CollectionMapper $mapper,
                                CollectionFormHydrator $formHydrator,
                                CollectionDbHydrator $dbHydrator,
                                ImageService $imageService)
    {
        $this->mapper = $mapper;
        $this->formHydrator = $formHydrator;
        $this->dbHydrator = $dbHydrator;
        $this->imageService = $imageService;
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
     * @return array of Collection objects
     */
    public function fetchAll()
    {
        $collectionObjects = [];
        $collections = $this->mapper->fetchAll();

        foreach ($collections as $collection) {
            $object = new Collection();
            $collectionObjects[] = $this->dbHydrator->hydrate($collection, $object);
        }

        return $collectionObjects;
    }

    public function selectBoxCollections()
    {
        $valueOptions = [];
        $collections = $this->mapper->fetchAll();
        foreach ($collections as $collection) {
            $key = $collection['collection_id'];
            $valueOptions[$key] = $collection['name'] . ' (' . $collection['tagname'] . ')';
        }
        return $valueOptions;
    }

    public function collectionPhotoCountLookup()
    {
        // convert the result set from associative array into a lookup table
        $results = $this->mapper->collectionPhotoCount();

        $lookup = [];
        foreach ($results as $r) {
            $lookup[(int) $r['collection_id']] = (int) $r['num_photos'];
        }

        return $lookup;
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

    /**
     * @param int $collectionId
     * @return Collection with onboard Image objects
     */
    public function fetchCollection($collectionId)
    {
        $collection = new Collection();
        $collection = $this->dbHydrator->hydrate(
            $this->mapper->fetchCollection($collectionId),
            $collection
        );
        return $collection->setImages(
            $this->imageService->fetchAllByCollectionId($collectionId, ['priority', 'collection_id'])
        );
    }

    /**
     * Permanently remove a collection
     *
     * @param int $collectionId the collection to delete
     */
    public function deleteCollection($collectionId)
    {
        $this->mapper->delete((int) $collectionId);
    }
}
