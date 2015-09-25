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
     * @var string the local time zone datetimezone string
     */
    protected $localTimeZone;

    /**
     * @param VehicleService $service
     * @param array $config the application configuration
     */
    public function __construct(VehicleService $service, array $config)
    {
        $this->service = $service;
        if (isset($config['system']['timezones']['local'])) {
            $this->localTimeZone =  $config['system']['timezones']['local'];
        }
    }

    public function listAction()
    {
        $vehiclesMap = $this->service->fetchVehiclesByDistinctCategoriesPriceDesc();

        $viewModel = new ViewModel([
            'vehiclesMap'   => $vehiclesMap,
            'localTimeZone' => $this->localTimeZone
        ]);
        $viewModel->setTemplate('view/list-vehicles/list.phtml');
        return $viewModel;
    }
}
