<?php
namespace Serenity\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Nitrogen\View\ViewModel;
use Nitrogen\Mvc\Controller\AbstractController;

use Serenity\Form\VehicleForm;
use Serenity\Service\VehicleService;

class AddEditVehicleController extends AbstractController
{
    /**
     * @var VehicleForm
     */
    protected $form;

    /**
     * @var VehicleService
     */
    protected $service;

    /**
     * @param VehicleForm $form
     * @param VehicleService $service
     */
    public function __construct(VehicleForm $form, VehicleService $service)
    {
        $this->form = $form;
        $this->service = $service;
    }

    /**
     * @return ViewModel
     */
    public function addAction()
    {
        if ($this->request->getMethod() === Request::METHOD_POST) {
            $data = $this->request->request->all();
            $this->form->setData($data);

            if ($this->form->isValid()) {
                $postProcessedData = $this->form->getData();
                if (isset($data['features'])) {
                    $postProcessedData['features'] = $data['features'];
                }
                $this->service->addVehicle($postProcessedData);
                return $this->redirectToRoute('admin_list_vehicles');
            }
        }

        $viewModel = new ViewModel([
            'form'              => $this->form,
            'featureCheckboxes' => $this->service->generateFeatureCheckboxes(
                                       isset($data['features']) ? $data['features'] : []),
            'action'            => $this->urlGenerator->generate('admin_add_edit_vehicle_add')
        ]);
        $viewModel->setTemplate('view/add-edit-vehicle/add-edit.phtml');
        return $viewModel;
    }

    public function editAction()
    {
        $vehicleId = $this->getRouteParam('vehicle_id');

        if ($this->request->getMethod() === Request::METHOD_POST) {
            $data = $this->request->request->all();
            $this->form->setData($data);

            if ($this->form->isValid()) {
                $postProcessedData = $this->form->getData();
                if (isset($data['features'])) {
                    $postProcessedData['features'] = $data['features'];
                }
                $this->service->updateVehicle($postProcessedData);
                return $this->redirectToRoute('admin_list_vehicles');
            }
        } else {
            $vehicle = $this->service->fetchByVehicleId($vehicleId);
            $data = $this->service->vehicleObjectToFormData($vehicle);
            unset($data['page-html']);
            $this->form->setData($data);
        }

        $viewModel = new ViewModel([
            'form'              => $this->form,
            'featureCheckboxes' => $this->service->generateFeatureCheckboxes($data['features']),
            'action'            => $this->urlGenerator->generate(
                'admin_add_edit_vehicle_edit',
                ['vehicle_id' => $vehicleId]
            )
        ]);
        $viewModel->setTemplate('view/add-edit-vehicle/add-edit.phtml');
        return $viewModel;
    }
}
