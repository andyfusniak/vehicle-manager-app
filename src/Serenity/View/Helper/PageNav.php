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
        $html = '<ul class="nav nav-justified">';
        foreach ($pageUrlNames as $key => $data) {
            // skip the homepage as this is static on the lower nav
            if ($data['url'] === 'homepage') {
                continue;
            }

            $html .= '<li role="presentation" id="nav-' . $data['url'] . '"';
            if ($url === $data['url']) {
                $html .= ' class="active"';
            }
            $html .= '>';
            $html .= '<a href="/' . $data['url'] . '">' . $data['name'] .'</a></li>';
        }
        $html .= '</ul>';
        return $html;
    }
}
