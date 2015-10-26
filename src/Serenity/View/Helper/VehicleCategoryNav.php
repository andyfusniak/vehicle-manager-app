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
            default:
                return 'Unknown';
        }
    }

    public function __invoke($activeTab = null)
    {
        $vehicleTypes = $this->vehicleService->fetchVehicleCategoriesArray();
        $html = '<ul id="sl-category-tabs" class="nav nav-justified">';

        $html .= '<li id="nav-home" role="presentation"';
        if ($activeTab === 'homepage') {
            $html .= ' class="active"';
        }
        $html .= '><a href="/">HOME</a>';

        foreach ($vehicleTypes as $name) {
            $html .= '<li id="nav-' .$name . '" role="presentation"';
            if ($name === $activeTab) {
                $html .= ' class="active"';
            }
            $html .= '><a href="/' . $name . '">' . $this->vehicleType($name) . '</a></li>';
        }

        $html .= '</ul>';
        return $html;
    }
}
