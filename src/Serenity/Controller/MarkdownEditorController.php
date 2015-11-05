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
        if ($this->request->getMethod() === Request::METHOD_POST) {
        }

        $viewModel = new ViewModel([
            'form' => $this->markdownEditorForm
        ]);
        $viewModel->setTemplate('view/markdown-editor/edit.phtml');
        return $viewModel;
    }
}
