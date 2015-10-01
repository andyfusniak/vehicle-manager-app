<?php
namespace Serenity\View\Helper;

use Nitrogen\View\Helper\AbstractHelper;
use Serenity\Entity;

class Image extends AbstractHelper
{
    public function __invoke(Entity\Image $image, $size = 250, $basePath = '/images/vehicles')
    {
        $imageId = (string) $image->getImageId();
        $filename = $basePath . '/'
                  . $imageId
                  . '_' . (string) $size . '.' . $image->getExtension();
        return '<img class="img-thumbnail" src="' . $filename . '" alt="' . $imageId . '">';
    }
}
