<?php
namespace Serenity\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Nitrogen\View\ViewModel;
use Nitrogen\Mvc\Controller\AbstractController;

use Serenity\Service\VehicleService;
use Serenity\Form\FeaturedVehiclesForm;

class FeaturedVehiclesController extends AbstractController
{
    /**
     * @var FeaturedVehiclesForm
     */
    protected $form;

    /**
     * @var VehicleService
     */
    protected $service;

    public function __construct(FeaturedVehiclesForm $form, VehicleService $service)
    {
        $this->form = $form;
        $this->service = $service;
    }

    public function featuredAction()
    {
        if ($this->request->getMethod() === Request::METHOD_POST) {
            $data = $this->request->request->all();
            $this->form->setData($data);

            if ($this->form->isValid()) {
                $data = $this->form->getData();
                $this->service->featureVehicle($data['featured-vehicle-id']);
                return $this->redirectToRoute('admin_list_vehicles');
            }
        }

        $viewModel = new ViewModel([
            'form' => $this->form
        ]);
        $viewModel->setTemplate('view/featured-vehicles/featured.phtml');
        return $viewModel;
    }
}
