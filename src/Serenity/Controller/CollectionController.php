<?php
namespace Serenity\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Nitrogen\View\ViewModel;
use Nitrogen\Mvc\Controller\AbstractController;

use Serenity\Form\CollectionForm;
use Serenity\Service\CollectionService;

class CollectionController extends AbstractController
{
    /**
     * @var CollectionForm
     */
    protected $form;

    /**
     * @var CollectionService
     */
    protected $service;

    /**
     * @param CollectionForm $form
     * @param CollectionService $service
     */
    public function __construct(CollectionForm $form, CollectionService $service)
    {
        $this->form = $form;
        $this->service = $service;
    }

    /**
     * @return ViewModel
     */
    public function addEditAction()
    {
        if ($this->request->getMethod() === Request::METHOD_POST) {
            $data = $this->request->request->all();
            $this->form->setData($data);

            if ($this->form->isValid()) {
                $this->service->addCollection($data);
                die('added');
            }
        }

        $viewModel = new ViewModel([
            'form' => $this->form
        ]);
        $viewModel->setTemplate('view/collection/add-edit.phtml');
        return $viewModel;
    }
}
