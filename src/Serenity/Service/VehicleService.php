<?php
namespace Serenity\Service;

use Serenity\Entity\Vehicle;
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

    public function __construct(VehicleMapper $mapper,
                                VehicleFormHydrator $formHydrator)
    {
        $this->mapper = $mapper;
        $this->formHydrator = $formHydrator;
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
        return $this->hydrator->formHydrate($this->mapper->fetchByVehicleId($vehicleId), $vehicle);
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
