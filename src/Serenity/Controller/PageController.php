<?php
namespace Serenity\Controller;

use Symfony\Component\HttpFoundation\Request;

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
                return $this->redirectToRoute('admin_page_view');
            }
        }

        $viewModel = new ViewModel([
            'form'   => $this->form,
            'action' => $this->urlGenerator->generate('admin_page_add')
        ]);
        $viewModel->setTemplate('view/page/add-edit.phtml');
        return $viewModel;
    }

    public function editAction()
    {
        if ($this->request->getMethod() === Request::METHOD_POST) {
            $data = $this->request->request->all();
            $this->form->setData($data);

            if ($this->form->isValid()) {
                $this->service->updatePage($this->form->getData());
                return $this->redirectToRoute('admin_page_view');
            }

            $pageId = $data['page-id'];
        } else {
            $pageId = $this->getRouteParam('page_id');
            $data = $this->service->pageObjectToFormData(
                $this->service->fetchPageByPageId($pageId)
            );
            unset($data['page_html']);
            unset($data['created']);
            unset($data['modified']);
            $this->form->setData($data);
        }

        $viewModel = new ViewModel([
            'form'   => $this->form,
            'action' => $this->urlGenerator->generate(
                'admin_page_edit',
                ['page_id' => $pageId]
            )
        ]);
        $viewModel->setTemplate('view/page/add-edit.phtml');
        return $viewModel;
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

    public function deleteAction()
    {
        $pageId = $this->getRouteParam('page_id');

        if ($pageId !== null) {
            $this->service->deletePage((int) $this->getRouteParam('page_id'));
        }
        return $this->redirectToRoute('admin_page_view');
    }

    public function orderingAction()
    {
        if ($this->request->getMethod() === Request::METHOD_POST) {
            $data = $this->request->request->all();

            $this->service->updatePageOrder($data);
            $viewModel = new ViewModel();
            $viewModel->setTemplate('view/page/json-success.phtml');
            $this->getLayout()->setTemplate('view/layout/emptylayout.phtml');
            return $viewModel;
        } else {
            $viewModel = new ViewModel([
                'pages' => $this->service->fetchAll()
            ]);
            $viewModel->setTemplate('view/page/ordering.phtml');
            return $viewModel;
        }

    }
}
