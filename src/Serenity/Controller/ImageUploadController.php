<?php
namespace Serenity\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Nitrogen\View\ViewModel;
use Nitrogen\Mvc\Controller\AbstractController;

use Serenity\Form\ImageUploadForm;
use Serenity\Service\ImageService;

class ImageUploadController extends AbstractController
{
    /**
     * @var ImageUploadForm
     */
    protected $form;

    /**
     * @var ImageService
     */
    protected $service;

    public function __construct(ImageUploadForm $form, ImageService $service)
    {
        $this->form = $form;
        $this->service = $service;
    }

    public function uploadAction()
    {
        if ($this->request->getMethod() === Request::METHOD_POST) {
            $data = $this->request->request->all();

            var_dump($data);


            $this->form->setData($data);

            if ($this->form->isValid()) {
               $this->service->saveImages($this->request->files->get('filename'));
            }
        }

        $viewModel = new ViewModel([
            'form' => $this->form
        ]);
        $viewModel->setTemplate('view/image-upload/upload.phtml');
        return $viewModel;
    }
}
