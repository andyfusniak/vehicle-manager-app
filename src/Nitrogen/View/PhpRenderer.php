<?php
namespace Nitrogen\View;

use Nitrogen\View\ViewModel;

class PhpRenderer
{
    /**
     * Process a view script and return the output
     * @param ViewModel $viewModel view model with its template set
     */
    public function render(ViewModel $viewModel)
    {
        $filename = $viewModel->getTemplate();

        try {
            // Turn on output buffering
            ob_start();
            include $filename;

            // Get current buffer contents and delete current output buffer
            $content = ob_get_clean();
        } catch (\Exception $e) {
            // Clean (erase) the output buffer and turn off output buffering
            ob_end_clean();
            throw $e;
        }

        return $content;
    }
}
