<?php
namespace Vm\Validator;

use Nitrogen\Validator\AbstractValidator;
use Nitrogen\Validator\Exception;
use Vm\Service\PageService;
use Vm\Service\VehicleService;

class PageUrlTakenValidator extends AbstractValidator
{
    const PAGE_URL_TAKEN = 'pageUrlTaken';
    const IN_USE_AS_VEHICLE_URL = 'inUseAsVehicleUrl';

    /**
     * @var PageService
     */
    protected $pageService;

    /**
     * @var VehicleService
     */
    protected $vehicleService;

    /**
     * @param PageService $service
     */
    public function __construct(PageService $pageService, VehicleService $vehicleService)
    {
        $this->pageService = $pageService;
        $this->vehicleService = $vehicleService;
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

        // if the 'page-id' form data is set, we must be editing
        // so we check the url in the context of updating the form
        // i.e. we don't check the url for the current page's url
        if (empty($context['page-id'])) {
            $pageId = null;
        } else {
            $pageId = (int) $context['page-id'];
        }

        $this->setValue($value);

        if ($this->vehicleService->isUrlTaken($value)) {
            $this->messages[self::IN_USE_AS_VEHICLE_URL] = 'The page url clashes with a vehicle url in the vehicles.  Urls must be unique across the entire website';
            return false;
        }

        if ($this->pageService->isUrlTaken($value, $pageId)) {
            $this->messages[self::PAGE_URL_TAKEN] = 'This page url is already in use';
            return false;
        }
        return true;
    }
}
