<?php
namespace Serenity\Controller;

use Nitrogen\View\ViewModel;
use Nitrogen\Mvc\Controller\AbstractController;

use Serenity\Service\VehicleService;

class DeleteVehicleController extends AbstractController
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

    public function confirmAction()
    {
        $vehicleId = $this->getRouteParam('vehicle_id');
        $vehicleObj = $this->service->fetchByVehicleId($vehicleId);
        $collectionObj = $this->service->getCollectionService()->fetchCollection(
            $vehicleObj->getCollectionId()
        );

        $viewModel = new ViewModel([
            'action'        => $this->urlGenerator->generate('admin_delete_vehicle_post'),
            'actionCancel'  => $this->urlGenerator->generate('admin_delete_vehicle_cancel_post'),
            'vehicleId'     => $vehicleId,
            'vehicleObj'    => $vehicleObj,
            'collectionObj' => $collectionObj
        ]);
        $viewModel->setTemplate('view/delete-vehicle/delete.phtml');
        return $viewModel;
    }

    public function deleteAction()
    {
        $vehicleId = (int) $this->request->get('vehicle_id');
        $this->service->deleteVehicle($vehicleId);
        return $this->redirectToRoute('admin_list_vehicles');
    }

    public function cancelAction()
    {
        return $this->redirectToRoute('admin_list_vehicles');
    }
}
