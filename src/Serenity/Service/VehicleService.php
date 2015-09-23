<?php
namespace Serenity\Service;

use Serenity\Entity\Vehicle;
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
        $vehicle = new Vehicle();
        return $this->formHydrator->hydrate($this->mapper->fetchByVehicleId($vehicleId), $vehicle);
    }

    /**
     * @return array of Vehicle objects
     */
    public function fetchAll()
    {
        $vehicleObjects = [];
        $vehicles = $this->mapper->fetchAll();

        foreach ($vehicles as $vehicle) {
            $object = new Vehicle();
            $vehicleObjects[] = $this->dbHydrator->hydrate($vehicle, $object);
        }

        return $vehicleObjects;
    }

    /**
     * @param array $vehicle the vehicle to update with id set
     * @return void
     */
    public function updateVehicle($data)
    {
        $vehicle = new Vehicle();
        $this->mapper->update($this->formHydrator->hydrate($data, $vehicle));
    }

    /**
     * @param string $url check url
     * @return bool returns true or false
     */
    public function isUrlTaken($url)
    {
        return $this->mapper->isUrlTaken($url);
    }
}
