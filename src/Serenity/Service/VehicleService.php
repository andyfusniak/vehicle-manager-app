<?php
namespace Serenity\Service;

use Serenity\Entity\Vehicle;
use Serenity\Entity\VehicleFeatures;
use Serenity\Hydrator\VehicleDbHydrator;
use Serenity\Hydrator\VehicleFormHydrator;
use Serenity\Mapper\VehicleMapper;

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

    public function __construct(VehicleMapper $mapper,
                                VehicleFormHydrator $formHydrator,
                                VehicleDbHydrator $dbHydrator)
    {
        $this->mapper = $mapper;
        $this->formHydrator = $formHydrator;
        $this->dbHydrator = $dbHydrator;
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
                    'tagname' => $data['tagname'],
                    'name'    => $data['collection_name']
                ]
            ];
        }

        return $vehiclesMap;
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
}
