<?php
namespace Nitrogen\View;

use Nitrogen\View\ViewModel;
use Nitrogen\View\HelperPluginManager;

class PhpRenderer
{
    /**
     * @var string filename
     */
    private $filename;

    /**
     * @var array private copy of vars
     */
    private $vars;

    /**
     * @var HelperPluginManager
     */
    private $helperPluginManager;

    /**
     * Inject the helper plugin manager instance
     *
     * @param HelperPluginManager $helperPluginManager
     * @return PhpRenderer
     */
    public function setHelperPluginManager(HelperPluginManager $helperPluginManager)
    {
        $this->helperPluginManager = $helperPluginManager;
        return $this;
    }

    /**
     * Process a view script and return the output
     * @param ViewModel $viewModel view model with its template set
     */
    public function render(ViewModel $viewModel)
    {
        $this->filename = $viewModel->getTemplate();

        // private vars not accessible inside the view
        // cannot clobber the 'this' variable
        $this->vars = $viewModel->getVariables();
        if (array_key_exists('this', $this->vars)) {
            unset($this->vars['this']);
        }
        extract($this->vars);

        try {
            // Turn on output buffering
            ob_start();
            $includeReturn = include $this->filename;

            // Get current buffer contents and delete current output buffer
            $content = ob_get_clean();
        } catch (\Exception $e) {
            // Clean (erase) the output buffer and turn off output buffering
            ob_end_clean();
            throw $e;
        }
        if ($includeReturn === false) {
            throw new Exception\UnexpectedValueException(sprintf(
                '%s: Unable to render template "%s"; file include failed',
                __METHOD__,
                $this->filename
            ));
        }

        return $content;
    }

    /**
     * Proxy to view helpers
     */
    public function __call($method, $argv)
    {
        $plugin = $this->helperPluginManager->get($method);

        if (is_callable($plugin)) {
            return call_user_func_array($plugin, $argv);
        }
        throw new \Exception(sprintf(
            '%s: failed to call help plugin %s',
            __METHOD__,
            $method
        ));
    }
}
