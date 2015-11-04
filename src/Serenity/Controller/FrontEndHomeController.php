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
        $viewModel = new ViewModel([
            'url'  => 'homepage',
            'page' => $this->pageService->fetchPageByUrl('homepage'),
            'fv'   => $this->vehicleService->fetchFeaturedVehicle()
        ]);
        $viewModel->setTemplate('view/front-end/home.phtml');
        return $viewModel;
    }
}
