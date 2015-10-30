<?php
namespace Serenity\View\Helper;

use Nitrogen\View\Helper\AbstractHelper;
use Serenity\Entity\Page;
use Serenity\Service\PageService;
use Serenity\Service\VehicleService;

class VehicleCategoryNav extends AbstractHelper
{
    /**
     * @var VehicleService
     */
    protected $vehicleService;

    /**
     * @var PageService
     */
    protected $pageService;

    public function __construct(VehicleService $vehicleService,
                                PageService $pageService)
    {
        $this->vehicleService = $vehicleService;
        $this->pageService = $pageService;
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
        $pageUrlNames = $this->pageService->fetchUrlAndPageNamesByLayoutPosition(Page::LAYOUT_POSITION_MAIN);
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

        foreach ($pageUrlNames as $key => $data) {
            // skip the homepage as this is static
            if ($data['url'] === 'homepage') {
                continue;
            }

            $html .= '<li id="nav-' . $data['url'] . '" role="presentation"';
            if ($activeTab === $data['url']) {
                $html .= ' class="active"';
            }
            $html .= '><a href="/' . $data['url'] . '">' . $data['name'] .'</a></li>';
        }

        $html .= '</ul>';
        return $html;
    }
}
