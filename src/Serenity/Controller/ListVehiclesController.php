<?php
namespace Serenity\Controller;

use Nitrogen\View\ViewModel;
use Nitrogen\Mvc\Controller\AbstractController;

use Serenity\Service\VehicleService;

class ListVehiclesController extends AbstractController
{
    /**
     * @var VechileService
     */
    protected $service;

    /**
     * @param VehicleService $service
     */
    public function __construct(VehicleService $service)
    {
        $this->service = $service;
    }

    public function listAction()
    {
        $vehicles = $this->service->fetchAll();

        $viewModel = new ViewModel([
            'vehicles' => $vehicles
        ]);
        $viewModel->setTemplate('view/list-vehicles/list.phtml');
        return $viewModel;
    }
}
