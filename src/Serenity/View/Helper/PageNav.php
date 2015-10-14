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

    public function __invoke($url = null)
    {
        return $this->render($url);
    }

    protected function render($url)
    {
        $pageUrlNames = $this->pageService->fetchUrlAndPageNames();

        $html = '<nav class="navbar navbar-default navbar-static-top sl-top-nav">';
        $html .= '<div class="container">';
        $html .= '<div id="nav-dashboard" class="navbar-header active">';
        $html .= '<a class="navbar-brand" href="/"><img class="sl-top-logo" src="images/serenity-logo-xs.png"></a>';
        $html .= '</div>';

        $html .= '<div>';
        foreach ($pageUrlNames as $key => $data) {
            if ($data['url'] === 'homepage') {
                continue;
            }
            $html .= '<ul class="nav navbar-nav navbar-collapse">';
            $html .= '<li id="nav-' . $data['url'] . '"';
            if ($url === $data['url']) {
                $html .= ' class="active"';
            }
            $html .= '>';
            $html .= '<a href="/' . $data['url'] . '">' . $data['name'] .'</a></li>';
            $html .= '</ul>';
        }
        $html .= '</div>';

        $html .= '</div>';
        $html .= '</div>';
        $html .= '</nav>';
        return $html;
    }
}
