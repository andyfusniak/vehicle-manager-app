<?php
namespace Vm\View\Helper;

use Nitrogen\View\Helper\AbstractHelper;

class HeadMeta extends AbstractHelper
{
    /**
     * @var string comma separated list of keywords
     */
    protected $metaKeywords;

    /**
     * @var string meta desription
     */
    protected $metaDesc;

    /**
     * @var string
     */
    protected $title;

    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;
        return $this;
    }

    public function setMetaDescription($metaDesc)
    {
        $this->metaDesc = $metaDesc;
        return $this;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function __invoke()
    {
        return $this;
    }

    public function __toString()
    {
        $result = '';

        if ($this->metaKeywords !== null) {
            $result .= '<meta name="keywords" content="' . $this->metaKeywords . '">' . PHP_EOL;
        }

        if ($this->metaDesc !== null) {
            $result .= '<meta name="description" content="' . $this->metaDesc . '">' . PHP_EOL;
        }

        if ($this->title !== null) {
            $result .= '<title>' . $this->title . '</title>';
        }

        return $result;
    }
}
