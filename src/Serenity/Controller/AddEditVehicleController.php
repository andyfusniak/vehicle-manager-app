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
     * @param VehicleForm $vehicleForm form
     */
    public function __construct(VehicleForm $form, VehicleService $service)
    {
        $this->form = $form;
        $this->service = $service;
    }

    /**
     * @param Request $request http request
     * @return ViewModel
     */
    public function addEditAction()
    {
        if ($this->request->getMethod() === Request::METHOD_POST) {
            $data = $this->request->request->all();
            $this->form->setData($data);

            if ($this->form->isValid()) {
                $this->service->addVehicle($data);
                //die('added');
            }
        }

        $viewModel = new ViewModel([
            'form' => $this->form
        ]);
        $viewModel->setTemplate('view/add-edit-vehicle/add-edit.phtml');
        return $viewModel;
    }
}
