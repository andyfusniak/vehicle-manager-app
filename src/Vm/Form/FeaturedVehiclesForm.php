<?php
namespace Vm\Form;

use Nitrogen\Form\Form;
use Nitrogen\Form\Element;
use Nitrogen\ServiceManager\HelperPluginManager;
use Nitrogen\Validator\ValidatorChain;

use Vm\Service\VehicleService;

class FeaturedVehiclesForm extends Form
{
    public function __construct(HelperPluginManager $helperPluginManager,
                                VehicleService $vehicleService)
    {
        $vehicles = $vehicleService->selectBoxFeaturedVehicles();
        $featuredVehicleId = new Element\Select('featured-vehicle-id');
        $featuredVehicleId->setValueOptions($vehicles)->setEmptyOption('--select--');
        $featuredVehicleIdChain = new ValidatorChain($helperPluginManager);
        $featuredVehicleIdChain->attach('validatornotempty');
        $featuredVehicleId->setValidatorChain($featuredVehicleIdChain);

        $this->add([
            $featuredVehicleId
        ]);
    }
}
