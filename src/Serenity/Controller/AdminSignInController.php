<?php
namespace Serenity\Controller;

use Symfony\Component\HttpFoundation\Request;

use Nitrogen\View\ViewModel;
use Nitrogen\Mvc\Controller\AbstractController;
use Serenity\Form\AdminSignInForm;

class AdminSignInController extends AbstractController
{
    /**
     * @var AdminSignInForm
     */
    protected $form;

    public function __construct(AdminSignInForm $form)
    {
        $this->form = $form;
    }

    public function authAction()
    {
        if ($this->request->getMethod() === Request::METHOD_POST) {
            $data = $this->request->request->all();
        }

        $viewModel = new ViewModel([
            'form' => $this->form
        ]);
        $viewModel->setTemplate('view/admin-sign-in/auth.phtml');
        return $viewModel;
    }
}
