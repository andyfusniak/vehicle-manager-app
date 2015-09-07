<?php
namespace Nitrogen\View\Helper;

class EscapeHtml extends AbstractHelper
{
    public function __invoke($value)
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, $this->encoding);
    }
}
