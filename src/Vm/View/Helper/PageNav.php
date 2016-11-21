<?php
namespace Vm\View\Helper;

use Nitrogen\View\Helper\AbstractHelper;
use Vm\Entity\Page;
use Vm\Service\PageService;

class PageNav extends AbstractHelper
{
    /**
     * @var PageService
     */
    protected $pageService;

    /**
     * @var string
     */
    protected $url;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function __invoke()
    {
        return $this;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function __toString()
    {
        $pageUrlNames = $this->pageService->fetchUrlAndPageNamesByLayoutPosition(Page::LAYOUT_POSITION_TOP);
        $html = '<ul class="nav nav-justified">';
        foreach ($pageUrlNames as $key => $data) {
            // skip the homepage as this is static on the main nav
            if ($data['url'] === 'homepage') {
                continue;
            }

            $html .= '<li role="presentation" id="nav-' . $data['url'] . '">';
            $html .= '<a href="/' . $data['url'] . '"';
            if ($this->url === $data['url']) {
                $html .= ' class="active"';
            }
            $html .= '>' . preg_replace('/ /', '&nbsp;', $data['name']) . '</a></li>';
        }
        $html .= '</ul>';
        return $html;
    }
}
