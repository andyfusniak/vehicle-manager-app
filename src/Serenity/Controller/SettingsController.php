<?php
namespace Serenity\Controller;

use Nitrogen\View\ViewModel;
use Nitrogen\Mvc\Controller\AbstractController;

class SettingsController extends AbstractController
{
    public function overviewAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTemplate('view/settings/overview.phtml');
        return $viewModel;
    }
}
