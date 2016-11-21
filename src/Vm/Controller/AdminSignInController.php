<?php
namespace Vm\Controller;

use Symfony\Component\HttpFoundation\Request;

use Nitrogen\View\ViewModel;
use Nitrogen\Mvc\Controller\AbstractController;
use Vm\Entity\Admin;
use Vm\Form\AdminSignInForm;
use Vm\Service\AuthService;

class AdminSignInController extends AbstractController
{
    /**
     * @var AdminSignInForm
     */
    protected $form;

    /**
     * @var AuthService
     */
    protected $authService;

    public function __construct(AdminSignInForm $form,
                                AuthService $authService)
    {
        $this->form = $form;
        $this->authService = $authService;
    }

    public function authAction()
    {
        if ($this->request->getMethod() === Request::METHOD_POST) {
            $data = $this->request->request->all();

            $this->form->setData($data);

            if ($this->form->isValid()) {
                $postValidationData = $this->form->getData();

                $admin = $this->authService->validateLogin(
                    $postValidationData['username'],
                    $postValidationData['passwd']
                );

                if ($admin != null) {
                    $this->authService->login($admin);
                    return $this->redirectToRoute('admin_dashboard');
                }

                return $this->redirectToRoute('admin_sign_in_failed');
            }
        }

        $viewModel = new ViewModel([
            'form' => $this->form
        ]);
        $viewModel->setTemplate('view/admin-sign-in/auth.phtml');
        return $viewModel;
    }

    public function createAdminAction()
    {
        $admin = new Admin();
        $admin->setAdminId(null)
              ->setUsername('andy')
              ->setPasswd('andy12345');
        $this->authService->addAdministrator($admin);
        $viewModel = new ViewModel([
            'form' => $this->form
        ]);
        $viewModel->setTemplate('view/admin-sign-in/create-admin.phtml');
        return $viewModel;
    }

    public function failedAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTemplate('view/admin-sign-in/failed.phtml');
        return $viewModel;
    }

    public function signOutAction()
    {
        $this->authService->logout();
        return $this->redirectToRoute('admin_dashboard');
    }
}
