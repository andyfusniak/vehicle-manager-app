<?php
namespace Serenity\Controller;

use Nitrogen\View\ViewModel;
use Nitrogen\Mvc\Controller\AbstractController;
use Serenity\Service\PageService;
use Serenity\Service\VehicleService;

class FrontEndHomeController extends AbstractController
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

    public function indexAction()
    {
        $featuredVehicle = $this->vehicleService->fetchFeaturedVehicle();

        $viewModel = new ViewModel([
            'page'            => $this->pageService->fetchPageByUrl('homepage'),
            'featuredVehicle' => $featuredVehicle
        ]);
        $viewModel->setTemplate('view/front-end/home.phtml');
        return $viewModel;
    }
}
