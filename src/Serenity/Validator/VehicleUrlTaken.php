<?php
namespace Serenity\Validator;

use Nitrogen\Validator\AbstractValidator;
use Nitrogen\Validator\Exception;
use Serenity\Service\VehicleService;

class VehicleUrlTaken extends AbstractValidator
{
    const VEHICLE_URL_TAKEN = 'vehicleUrlTaken';

    /**
     * @var VehicleService
     */
    protected $service;

    /**
     * @param VehicleService $vehicleService
     */
    public function __construct(VehicleService $service)
    {
        $this->service = $service;
    }

    /**
     * @param string @value to validate
     * @return bool if it is valid returns true
     */
    public function isValid($value)
    {
        if (!is_string($value)) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s expects a string value',
                __METHOD__
            ));
        }

        $this->setValue($value);

        if ($this->service->isUrlTaken($value)) {
            $this->messages[self::VEHICLE_URL_TAKEN] = 'The url chosen is already in use';
            return false;
        }
        return true;
    }
}
