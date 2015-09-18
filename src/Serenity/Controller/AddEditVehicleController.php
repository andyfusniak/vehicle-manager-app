<?php
namespace Serenity\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Nitrogen\View\View;
use Nitrogen\View\ViewModel;

use Serenity\Form\VehicleForm;
use Serenity\Service\VehicleService;

class AddEditVehicleController
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
    public function addEditAction(Request $request)
    {
        if ($request->getMethod() === Request::METHOD_POST) {
            $data = $request->request->all();
            $this->form->setData($data);

            if ($this->form->isValid()) {
                $this->service->addVehicle($data);
                //die('added');
            } else {
                var_dump("ERRORS");
            }
        }

        $modelA = new ViewModel(array(
            'form' => $this->form
        ));
        $modelA->setTemplate('view/add-edit-vehicle/add-edit.phtml');
        return $modelA;
    }
}
