<?php
namespace Serenity\Controller;

use Nitrogen\View\ViewModel;
use Nitrogen\Mvc\Controller\AbstractController;

class DashboardController extends AbstractController
{
    public function indexAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTemplate('view/dashboard/index.phtml');
        return $viewModel;
    }
}
