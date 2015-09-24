<?php
namespace Serenity\Controller;

use Nitrogen\Mvc\Controller\AbstractController;
use Nitrogen\View\ViewModel;

use Serenity\Form\PageForm;
use Serenity\Service\PageService;

class PageController extends AbstractController
{
    /**
     * @var PageForm
     */
    protected $form;

    /**
     * @var PageService
     */
    protected $service;

    /**
     * @var array|null
     */
    protected $localTimeZone;

    public function __construct(PageForm $form, PageService $service, $config)
    {
        $this->form = $form;
        $this->service = $service;

        if (isset($config['system']['timezones']['local'])) {
            $this->localTimeZone =  $config['system']['timezones']['local'];
        }
    }

    public function addAction()
    {
        if ($this->request->getMethod() === Request::METHOD_POST) {
            $data = $this->request->request->all();
            $this->form->setData($data);

            if ($this->form->isValid()) {
                $this->service->addPage($data);
                $this->redirectToRoute('page_view');
            }
        }

        $viewModel = new ViewModel([
            'form'   => $this->form,
            'action' => $this->urlGenerator->generate('page_add')
        ]);
        $viewModel->setTemplate('view/add-edit-vehicle/add-edit.phtml');
        return $viewModel;
    }

    public function editAction()
    {
        $pageId = $this->getRouteParam('page_id');
        die('edit page');

    }

    public function listAction()
    {
        $viewModel = new ViewModel([
            'pages'         => $this->service->fetchAll(),
            'localTimeZone' => $this->localTimeZone
        ]);
        $viewModel->setTemplate('view/page/list.phtml');
        return $viewModel;
    }
}
