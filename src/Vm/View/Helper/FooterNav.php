<?php
namespace Vm\View\Helper;

use Nitrogen\View\Helper\AbstractHelper;
use Vm\Entity\Page;
use Vm\Service\PageService;

class FooterNav extends AbstractHelper
{
    /**
     * @var PageService
     */
    protected $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function __invoke($activeTab = null)
    {
        $pageUrlNames = $this->pageService->fetchUrlAndPageNamesByLayoutPosition(Page::LAYOUT_POSITION_FOOTER);
        $html = '<p>';
        $size = count($pageUrlNames);
        for($i = 0; $i < $size; $i++) {
            $data = $pageUrlNames[$i];
            // skip the homepage as this is static on the main nav
            if ($data['url'] === 'homepage') {
                continue;
            }

            $html .= '<a href="/' . $data['url'] . '" id="nav-' . $data['url'] . '">' . $data['name'] . '</a>';
            if ($i < $size - 1) {
                $html .= ' &nbsp;&middot;&nbsp; ';
            }
        }
        $html .= '</p>';
        return $html;
    }
}

