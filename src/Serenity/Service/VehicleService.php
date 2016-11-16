<?php
namespace Serenity\Service;

use Serenity\Entity\Vehicle;
use Serenity\Entity\VehicleFeatures;
use Serenity\Hydrator\VehicleDbHydrator;
use Serenity\Hydrator\VehicleFormHydrator;
use Serenity\Mapper\VehicleMapper;
use Serenity\Service\CollectionService;

class VehicleService
{
    /**
     * @var VehicleMapper
     */
    protected $mapper;

    /**
     * @var VehicleFormHydrator
     */
    protected $formHydrator;

    /**
     * @var VehicleDbHydrator
     */
    protected $dbHydrator;

    /**
     * @var CollectionService
     */
    protected $collectionService;

    public function __construct(VehicleMapper $mapper,
                                VehicleFormHydrator $formHydrator,
                                VehicleDbHydrator $dbHydrator,
                                CollectionService $collectionService)
    {
        $this->mapper = $mapper;
        $this->formHydrator = $formHydrator;
        $this->dbHydrator = $dbHydrator;
        $this->collectionService = $collectionService;
    }

    /**
     * Add a new vehicle to persistent storage
     *
     * @param array $vehicle the vehicle form data
     * @return the new vehicle id
     */
    public function addVehicle(array $data)
    {
        $vehicle = new Vehicle();
        return $this->mapper->insert($this->formHydrator->hydrate($data, $vehicle));
    }

    /**
     * @param int $vehicleId the primary key
     * @return Vehicle
     */
    public function fetchByVehicleId($vehicleId)
    {
        return $this->mapper->fetchByVehicleId($vehicleId);
    }

    /**
     * @return Vehicle|null
     */
    public function fetchFeaturedVehicle()
    {
        return $this->mapper->fetchFeaturedVehicle();
    }

    /**
     * Fetch new-in vehicles
     * @return array of Vehicle instances
     */
    public function fetchNewVehicles()
    {
        return $this->mapper->fetchNewVehicles();
    }

    /**
     * @param string $url the url slug of the vehicle to fetch
     * @return Vehicle object
     */
    public function fetchFullByUrl($url)
    {
        $vehicle = $this->mapper->fetchByUrl($url);

        $vehicle->setCollection(
            $this->collectionService->fetchCollection($vehicle->getCollectionId())
        );
        return $vehicle;
    }

    public function fetchVehicleNameMappings()
    {
        return VehicleFeatures::$titles;
    }

    public function vehicleObjectToFormData(Vehicle $vehicle)
    {
        return $this->formHydrator->extract($vehicle);
    }

    /**
     * @return array of Vehicle objects
     */
    public function fetchAll()
    {
        $vehicleObjects = [];
        $vehicles = $this->mapper->fetchAllAssocArray();

        foreach ($vehicles as $vehicle) {
            $object = new Vehicle();
            $vehicleObjects[] = $this->dbHydrator->hydrate($vehicle, $object);
        }

        return $vehicleObjects;
    }

    public function fetchVehiclesByDistinctCategoriesPriceDesc()
    {
        $vehiclesAssoc = $this->mapper->fetchVehiclesByDistinctCategoriesPriceDescAssocArray();

        $vehiclesMap = [];
        foreach ($vehiclesAssoc as $data) {
            $type = $data['type'];
            $vehiclesMap[$type][] = [
                'vehicleObj' => $this->dbHydrator->hydrate($data, new Vehicle()),
                'collection' => [
                    'collection_id' => $data['collection_id'],
                    'tagname'       => $data['tagname'],
                    'name'          => $data['collection_name']
                ]
            ];
        }

        return $vehiclesMap;
    }

    public function fetchAllVisibleByCategoryAssocArray($type, $orderBy = VehicleMapper::COLUMN_PRICE, $orderDirection = 'DESC')
    {
        $vehiclesAssoc = $this->mapper->fetchAllVisibleByCategoryAssocArray($type, $orderBy, $orderDirection);
        $vehiclesMap = [];
        foreach ($vehiclesAssoc as $data) {

            $vehiclesMap[] = [
                'vehicleObj' => $this->dbHydrator->hydrate($data, new Vehicle()),
                'image_id' => (int) $data['image_id']
            ];
        }
        return $vehiclesMap;
    }

    /**
     * @return array an associative array of vehicle ids and names for
     *               display select box
     */
    public function selectBoxFeaturedVehicles()
    {
        $valueOptions = [];
        $vehicles = $this->mapper->fetchVehicleIdAndNameAssocArray();
        foreach ($vehicles as $v) {
            $key = $v['vehicle_id'];
            $valueOptions[$key] = $v['page_title'] . ' (' . $v['url'] . ')';
        }
        return $valueOptions;
    }

    public function fetchVehicleCategoriesArray()
    {
        return [
            'caravans',
            'motorhomes',
            'awningrange',
            'newcaravans'
        ];
    }

    /**
     * @param array $vehicle the vehicle to update with id set
     * @return void
     */
    public function updateVehicle($data)
    {
        $vehicle = $this->formHydrator->hydrate($data, new Vehicle());
        $dbData = $this->dbHydrator->extract($vehicle);
        unset($dbData['created']);
        unset($dbData['modified']);
        $this->mapper->update($dbData);
    }

    /**
     * Make the given vehicle featured
     *
     * @param int $vehicleId the vehicle to be featured
     */
    public function featureVehicle($vehicleId)
    {
        $this->mapper->featuredVehicle((int) $vehicleId);
    }

    /**
     * Fetch the markdown only for a given vehicle
     *
     * @param int $vehicleId the vehicle primary key
     * @return string markdown text
     */
    public function fetchMarkdownOnlyByVehicleId($vehicleId)
    {
        return $this->mapper->fetchMarkdownOnlyByVehicleId((int) $vehicleId);
    }

    /**
     * Update the markdown only for a given vehicle
     *
     * @param int $vehicleId the vehicle id to update
     * @param string $markdown the new markdown text
     */
    public function updateMarkdownOnly($vehicleId, $markdown)
    {
        return $this->mapper->updateMarkdownOnly($vehicleId, $markdown);
    }

    /**
     *
     * See page service similar function for explanation
     *
     * @param string $url check url
     * @param int $vehicleId vehicle id context
     * @return bool returns true or false
     */
    public function isUrlTaken($url, $vehicleId = null)
    {
        return $this->mapper->isUrlTaken($url, $vehicleId);
    }

    public function generateFeatureCheckboxes(array $features)
    {
        $featureCheckboxes = [];
        foreach (VehicleFeatures::$titles as $value => $title) {
            $featureCheckboxes[$value] = [
                'title'     => $title,
                'isChecked' =>in_array($value, $features)
            ];
        }
        return $featureCheckboxes;
    }

    public function deleteVehicle($vehicleId)
    {
        $vehicle = $this->fetchByVehicleId($vehicleId);
        $collectionId = $vehicle->getCollectionId();
        $this->mapper->deleteVehicle($vehicle->getVehicleId());
        $this->collectionService->deleteCollectionAndImages($collectionId);
    }

    public function getCollectionService()
    {
        return $this->collectionService;
    }
}
