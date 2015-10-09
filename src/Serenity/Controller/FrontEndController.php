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

    public function displayAction()
    {
        $url = $this->getRouteParam('url');

        // vehicle category e.g. 'awningrange', 'motorhomes'
        $viewModel = new ViewModel();
        if (in_array($url, $this->vehicleService->fetchVehicleCategoriesArray())) {
            $viewModel->setTemplate('view/front-end/category.phtml');
            return $viewModel;
        }

        // page url e.g. 'contact-us', 'how-to-find-us'
        if ($this->pageService->isUrlTaken($url)) {
            $viewModel->setTemplate('view/front-end/page.phtml');
            return $viewModel;
        }

        // vehicle url e.g. 'schooner-motorhome-2015-model'
        if ($this->vehicleService->isUrlTaken($url)) {
            $viewModel->setTemplate('view/front-end/vehicle.phtml');
            return $viewModel;
        }

        $viewModel->setTemplate('view/front-end/display.phtml');
        return $viewModel;
    }
}
