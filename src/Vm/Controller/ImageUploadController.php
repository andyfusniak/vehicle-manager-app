<?php
namespace Vm\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Nitrogen\View\ViewModel;
use Nitrogen\Mvc\Controller\AbstractController;

use Vm\Form\ImageUploadForm;
use Vm\Service\ImageService;

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
            $this->form->setData($data);

            if ($this->form->isValid()) {
                $this->service->saveImages(
                    $data['collection-id'],
                    $this->request->files->get('filename')
                );
                return $this->redirectToRoute('admin_collection_list');
            }
        } else {
            $collectionId = $this->getRouteParam('collection_id');
            if ($collectionId !== null) {
                $this->form->get('collection-id')->setValue($collectionId);
            }
        }


        $viewModel = new ViewModel([
            'form' => $this->form
        ]);
        $viewModel->setTemplate('view/image-upload/upload.phtml');
        return $viewModel;
    }
}
