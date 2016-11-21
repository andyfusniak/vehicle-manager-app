<?php
namespace Vm\View\Helper;

use Nitrogen\View\Helper\AbstractHelper;
use Vm\Entity\Page;

class PageLayoutPosition extends AbstractHelper
{
    public function __invoke($value)
    {
        if (!array_key_exists($value, Page::$layoutPositionTitles)) {
            return 'Unknown';
        }

        return  Page::$layoutPositionTitles[$value];
    }
}
