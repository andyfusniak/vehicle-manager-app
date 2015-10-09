<?php
namespace Serenity\View\Helper;

use Nitrogen\View\Helper\AbstractHelper;
use Serenity\Service\PageService;

class PageNav extends AbstractHelper
{
    /**
     * @var PageService
     */
    protected $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function __invoke()
    {
        return $this->render();
    }

    protected function render()
    {
        $pageUrlNames = $this->pageService->fetchUrlAndPageNames();

        $html = '<nav class="navbar navbar-static-top">';
        $html .= '<div class="container-fluid">';
        $html .= '<div id="nav-dashboard" class="navbar-header">';

        foreach ($pageUrlNames as $key => $data) {
            $html .= '<a class="navbar-brand" href="/' . $data['url'] . '">' . $data['name'] .'</a>';
        }
        //
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</nav>';
        return $html;
    }
}
