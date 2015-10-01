<?php
namespace Nitrogen\View;

use Nitrogen\View\ViewModel;
use Nitrogen\View\PhpRenderer;

class View
{
    /**
     * @var ViewModel
     */
    protected $layout;

    /**
     * @var PhpRenderer
     */
    protected $renderer;

    public function setRenderer(PhpRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function getRenderer()
    {
        return $this->renderer;
    }

    public function render(ViewModel $viewModel)
    {
        if (!$this->renderer instanceof PhpRenderer) {
            throw new Exception\RuntimeException(sprintf(
               '%s: no renderer selected',
               __METHOD__
            ));
        }

        if ($viewModel->hasChildren()) {
            $this->renderChildren($viewModel);
        }

        return $this->renderer->render($viewModel);
    }

    public function renderChildren(ViewModel $viewModel)
    {
        foreach ($viewModel->getChildren() as $child) {
            $result = $this->render($child);

            $captureTo = $child->captureTo();

            if ($captureTo !== null) {
                $viewModel->setVariable($captureTo, $result);
            }
        }
    }
}
