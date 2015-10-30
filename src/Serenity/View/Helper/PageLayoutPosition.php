<?php
namespace Serenity\View\Helper;

use Nitrogen\View\Helper\AbstractHelper;
use Serenity\Entity\Page;

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
