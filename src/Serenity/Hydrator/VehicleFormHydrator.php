<?php
namespace Serenity\Hydrator;

use Nitrogen\Hydrator\AbstractFormHydrator;

use Serenity\Entity\Vehicle;

class VehicleFormHydrator extends AbstractFormHydrator
{
    public function extract($object)
    {
        return [
            'vehicle-id' => (string) $vehicle->getVehicleId(),
            'type'       => $vehicle->getType(),
            'visible'    => (string) $vehicle->getVisible(),
            // TODO must return strings
        ];
    }

    public function hydrate(array $data, $object)
    {
        $object->setVehicleId((int) $data['vehicle-id'])
               ->setType($data['type'])
               ->setVisible(($data['visible'] === '1') ? true : false)
               ->setSold(($data['sold'] === '1') ? true : false)
               ->setUrl($data['url'])
               ->setPrice((int) $data['price'])
               ->setMetaKeywords($data['meta-keywords'])
               ->setMetaDesc($data['meta-desc'])
               ->setPageTitle($data['page-title'])
               ->setMarkdown($data['markdown'])
               ->setPageHtml(isset($data['page-html']) ? $data['page-html'] : null);
        return $object;
    }
}
