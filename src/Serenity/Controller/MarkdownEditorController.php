<?php
namespace Serenity\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Nitrogen\View\ViewModel;
use Nitrogen\Mvc\Controller\AbstractController;

use Serenity\Form\MarkdownEditorForm;
use Serenity\Service\VehicleService;
use Serenity\Service\PageService;

class MarkdownEditorController extends AbstractController
{
    /**
     * @var VehicleService
     */
    protected $vehicleService;

    /**
     * @var PageService
     */
    protected $pageService;

    /**
     * @var MarkdownEditorForm
     */
    protected $markdownEditorForm;

    public function __construct(MarkdownEditorForm $markdownEditorForm,
                                VehicleService $vehicleService,
                                PageService $pageService)
    {
        $this->markdownEditorForm = $markdownEditorForm;
        $this->vehicleService = $vehicleService;
        $this->pageService = $pageService;
    }

    public function editAction()
    {
        $section = $this->getRouteParam('section');
        $id = $this->getRouteParam('id');

        if ($this->request->getMethod() === Request::METHOD_POST) {
            $data = $this->request->request->all();
            $this->markdownEditorForm->setData($data);

            if ($this->markdownEditorForm->isValid()) {
                $postProcessedData = $this->markdownEditorForm->getData();

                if ($section === 'vehicle') {
                    $this->vehicleService->updateMarkdownOnly(
                        $postProcessedData['id'],
                        $postProcessedData['markdown']
                    );
                    return $this->redirectToRoute('admin_list_vehicles');
                } else if ($section === 'page') {
                    $this->pageService->updateMarkdownOnly(
                        $postProcessedData['id'],
                        $postProcessedData['markdown']
                    );
                    return $this->redirectToRoute('admin_page_view');
                } else {
                    throw new \Exception(sprintf(
                        'Bad routing for %s',
                        __METHOD__
                    ));
                }
            }
        } else {
            $this->markdownEditorForm->get('id')->setValue($this->getRouteParam('id'));
            if ($section === 'vehicle') {
                $markdown = $this->vehicleService->fetchMarkdownOnlyByVehicleId($id);
            } else if ($section === 'page') {
                $markdown = $this->pageService->fetchMarkdownOnlyByPageId($id);
            } else {
                throw new \Exception(sprintf(
                    'Bad routing for %s',
                    __METHOD__
                ));
            }
            $this->markdownEditorForm->get('markdown')->setValue($markdown);
        }

        $viewModel = new ViewModel([
            'section' => $section,
            'form'    => $this->markdownEditorForm
        ]);
        $viewModel->setTemplate('view/markdown-editor/edit.phtml');
        return $viewModel;
    }
}
