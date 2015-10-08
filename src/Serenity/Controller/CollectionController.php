<?php
namespace Serenity\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Nitrogen\View\ViewModel;
use Nitrogen\Mvc\Controller\AbstractController;

use Serenity\Form\CollectionForm;
use Serenity\Service\CollectionService;
use Serenity\Service\ImageService;

class CollectionController extends AbstractController
{
    /**
     * @var CollectionForm
     */
    protected $form;

    /**
     * @var CollectionService
     */
    protected $collectionService;

    /**
     * @var ImageService
     */
    protected $imageService;

    /**
     * @var string the local time zone datetimezone string
     */
    protected $localTimeZone;

    /**
     * @param CollectionForm $form
     * @param CollectionService $service
     */
    public function __construct(CollectionForm $form,
                                CollectionService $collectionService,
                                ImageService $imageService,
                                array $config)
    {
        $this->form = $form;
        $this->collectionService = $collectionService;
        $this->imageService = $imageService;
        if (isset($config['system']['timezones']['local'])) {
            $this->localTimeZone =  $config['system']['timezones']['local'];
        }
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
                $this->collectionService->addCollection($data);
                return $this->redirectToRoute('admin_collection_list');
            }
        }

        $viewModel = new ViewModel([
            'form'          => $this->form
        ]);
        $viewModel->setTemplate('view/collection/add-edit.phtml');
        return $viewModel;
    }

    /**
     * @return ViewModel
     */
    public function listAction()
    {
        $collections = $this->collectionService->fetchAll();

        $photoCountMap = $this->collectionService->collectionPhotoCountLookup();

        $viewModel = new ViewModel([
            'collections'   => $collections,
            'photoCountMap' => $photoCountMap
        ]);
        $viewModel->setTemplate('view/collection/list.phtml');
        return $viewModel;
    }

    public function viewAction()
    {
        if ($this->request->getMethod() === Request::METHOD_POST) {
            $data = $this->request->request->all();

            if (isset($data['delete'])) {
                $this->imageService->deletePhotoOrder($data);
            } else {
                $this->imageService->updatePhotoOrder($data);
            }
            $viewModel = new ViewModel();
            $viewModel->setTemplate('view/collection/json-success.phtml');
            return $viewModel;
        }

        $collection = $this->collectionService->fetchCollection($this->getRouteParam('collection_id'));
        $viewModel = new ViewModel([
            'collection' => $collection,
            'images'     => $collection->getImages(),
            'localTimeZone' => $this->localTimeZone
        ]);
        $viewModel->setTemplate('view/collection/view.phtml');
        return $viewModel;
    }
}
