<?php
namespace Serenity\View\Helper;

use Nitrogen\View\Helper\AbstractHelper;
use Serenity\Service\VehicleService;

class VehicleCategoryNav extends AbstractHelper
{
    /**
     * @var VehicleService
     */
    protected $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    // TODO this duplicates functionality so need to be able to proxy to another view helpering from this one

    private function vehicleType($value)
    {
        switch ($value) {
            case 'caravans':
                return 'Caravans';
                break;
            case 'motorhomes':
                return 'Motorhomes';
                break;
            case 'awningrange':
                return 'Awning Range';
                break;
            case 'accessories':
                return 'Accessories';
                break;
            case 'cars':
                return 'Cars';
                break;
            default:
                return 'Unknown';
        }
    }

    public function __invoke($activeTab = null)
    {
        $vehicleTypes = $this->vehicleService->fetchVehicleCategoriesArray();
        $html = '<div class="container"><ul id="sl-category-tabs" class="nav nav-tabs">';

        foreach ($vehicleTypes as $name) {
            $html .= '<li id="nav-' .$name . '" role="presentation"';
            if ($name === $activeTab) {
                $html .= ' class="active"';
            }
            $html .= '><a href="/' . $name . '">' . $this->vehicleType($name) . '</a></li>';
        }

        $html .= '</ul></div>';
        return $html;
    }
}
