<?php
namespace Serenity\View\Helper;

use Nitrogen\View\Helper\AbstractHelper;
use Serenity\Entity\VehicleFeatures;

class VehicleFeature extends AbstractHelper
{
    public function __invoke($value)
    {
        $lookup = VehicleFeatures::$titles;

        if (array_key_exists($value, $lookup)) {
            return $lookup[$value];
        }

        return '';
    }
}
