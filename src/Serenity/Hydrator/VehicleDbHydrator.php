<?php
namespace Serenity\Hydrator;

use Serenity\Entity\Vehicle;

class VehicleDbHydrator extends AbstractDbHydrator
{
    public function extract($vehicle)
    {
        if (!$vehicle instanceof Vehicle) {
            throw new \InvalidArgumentException(sprintf(
                '%s: expects an instance of Vehicle; received "%s"',
                __METHOD__,
                (is_object($vehicle) ? get_class($vehicle) : gettype($vehicle))
            ));
        }

        return array(
            'vehicle_id'    => $vehicle->getVehicleId(),
            'type'          => $vehicle->getType(),
            'visible'       => $vehicle->getVisible(),
            'sold'          => $vehicle->getSold(),
            'url'           => $vehicle->getUrl(),
            'price'         => $vehicle->getPrice(),
            'meta_keywords' => $vehicle->getMetaKeywords(),
            'meta_desc'     => $vehicle->getMetaDesc(),
            'page_title'    => $vehicle->getPageTitle(),
            'markdown'      => $vehicle->getMarkdown(),
            'page_html'     => $vehicle->getPageHtml(),
            'created'       => $vehicle->getCreated()->format(self::MYSQL_FORMAT),
            'modified'      => $vehicle->getModified()->format(self::MYSQL_FORMAT)
        );
    }

    public function hydrate(array $data, $object)
    {
    }
}
