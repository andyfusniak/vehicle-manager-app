<?php
namespace Serenity\Validator;

use Nitrogen\Validator\AbstractValidator;
use Nitrogen\Validator\Exception;
use Serenity\Service\PageService;
use Serenity\Service\VehicleService;

class VehicleUrlTakenValidator extends AbstractValidator
{
    const VEHICLE_URL_TAKEN = 'vehicleUrlTaken';
    const IN_USE_AS_PAGE_URL = 'inUseAsPageUrl';

    /**
     * @var VehicleService
     */
    protected $vehicleService;

    /**
     * @param VehicleService $vehicleService
     * @param PageService $pageService
     */
    public function __construct(VehicleService $vehicleService, PageService $pageService)
    {
        $this->vehicleService = $vehicleService;
        $this->pageService = $pageService;
    }

    /**
     * @param string @value to validate
     * @return bool if it is valid returns true
     */
    public function isValid($value, $context = null)
    {
        if (!is_string($value)) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s expects a string value',
                __METHOD__
            ));
        }

        // if the 'vehicle-id' form data is set, we must be editing
        // so we check the url in the context of updating the form
        // i.e. we don't check the url for the current vehicle's url
        if (empty($context['vehicle-id'])) {
            $vehicleId = null;
        } else {
            $vehicleId = (int) $context['vehicle-id'];
        }

        $this->setValue($value);

        if ($this->pageService->isUrlTaken($value)) {
            $this->messages[self::IN_USE_AS_PAGE_URL] = 'The vehicle url clashes with a page url in the pages section.  Urls must be unique across the entire website';
            return false;
        }

        if ($this->vehicleService->isUrlTaken($value, $vehicleId)) {
            $this->messages[self::VEHICLE_URL_TAKEN] = 'The url chosen is already in use';
            return false;
        }
        return true;
    }
}
