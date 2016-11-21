<?php
namespace Vm\View\Helper;

use Nitrogen\View\Helper\AbstractHelper;
use Vm\Entity\VehicleFeatures;

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
