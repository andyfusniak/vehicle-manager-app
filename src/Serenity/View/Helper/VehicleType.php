<?php
namespace Serenity\View\Helper;

use Nitrogen\View\Helper\AbstractHelper;

class VehicleType extends AbstractHelper
{
    public function __invoke($value)
    {
        switch ($value) {
            case 'caravans':
                return 'Used Caravans';
                break;
            case 'motorhomes':
                return 'Motorhomes';
                break;
            case 'awningrange':
                return 'Awning Range';
                break;
            case 'newcaravans':
                return 'New Caravans';
            default:
                return 'Unknown';
        }
    }
}
