<?php
namespace Nitrogen\View;

use Nitrogen\View\ViewModel;
use Nitrogen\View\PhpRenderer;

class View
{
    /**
     * @var ViewModel
     */
    protected $viewModel;

    /**
     * @var PhpRenderer
     */
    protected $renderer;

    public function setRenderer(PhpRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function render(ViewModel $viewModel)
    {
        if (!$this->renderer instanceof PhpRenderer) {
            throw new Exception\RuntimeException(sprintf(
               '%s: no renderer selected',
               __METHOD__
            ));
        }

        return $this->renderer->render($viewModel);
    }
}
