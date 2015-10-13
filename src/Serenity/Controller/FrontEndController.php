<?php
namespace Serenity\Controller;

use Nitrogen\View\ViewModel;
use Nitrogen\Mvc\Controller\AbstractController;
use Serenity\Service\PageService;
use Serenity\Service\VehicleService;

class FrontEndController extends AbstractController
{
    /**
     * @var PageService
     */
    protected $pageService;

    /**
     * @var VehicleService
     */
    protected $vehicleService;

    public function __construct(PageService $pageService,
                                VehicleService $vehicleService)
    {
        $this->pageService = $pageService;
        $this->vehicleService = $vehicleService;
    }

    private function category($type)
    {
        $viewModel = new ViewModel([
            'vehiclesMap' => $this->vehicleService->fetchAllVisibleByCategoryAssocArray($type),
            'type'        => $type
        ]);
        $viewModel->setTemplate('view/front-end/category.phtml');
        return $viewModel;
    }

    private function vehicle($url)
    {
        $vehicle = $this->vehicleService->fetchFullByUrl($url);
        $collection = $vehicle->getCollection();
        $images = $collection->getImages();

        $viewModel = new ViewModel([
            'vehicle'    => $vehicle,
            'collection' => $collection,
            'images'     => $images,
            'hasImages'  => (count($images) > 0) ? true : false
        ]);
        $viewModel->setTemplate('view/front-end/vehicle.phtml');
        return $viewModel;
    }

    private function page($url)
    {
        $viewModel = new ViewModel([
            'page' => $this->pageService->fetchPageByUrl($url)
        ]);
        $viewModel->setTemplate('view/front-end/page.phtml');
        return $viewModel;
    }

    public function displayAction()
    {
        $url = $this->getRouteParam('url');

        // vehicle category e.g. 'awningrange', 'motorhomes'
        if (in_array($url, $this->vehicleService->fetchVehicleCategoriesArray())) {
            return $this->category($url);
        }

        // page url e.g. 'contact-us', 'how-to-find-us'
        if ($this->pageService->isUrlTaken($url)) {
            return $this->page($url);
        }

        // vehicle url e.g. 'schooner-motorhome-2015-model'
        if ($this->vehicleService->isUrlTaken($url)) {
            return $this->vehicle($url);
        }

        $viewModel = new ViewModel();
        $viewModel->setTemplate('view/front-end/display.phtml');
        return $viewModel;
    }
}
