<?php
namespace Serenity\Hydrator;

use Nitrogen\Hydrator\AbstractDbHydrator;
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
            'vehicle_id'    => (string) $vehicle->getVehicleId(),
            'type'          => $vehicle->getType(),
            'visible'       => ($vehicle->getVisible() === true) ? '1' : '0',
            'sold'          => ($vehicle->getSold() === true) ? '1' : '0',
            'url'           => $vehicle->getUrl(),
            'price'         => (string) $vehicle->getPrice(),
            'meta_keywords' => $vehicle->getMetaKeywords(),
            'meta_desc'     => $vehicle->getMetaDesc(),
            'page_title'    => $vehicle->getPageTitle(),
            'markdown'      => $vehicle->getMarkdown(),
            'page_html'     => $vehicle->getPageHtml(),
            'created'       => ($vehicle->getCreated() === null) ? null : $vehicle->getCreated()->format(self::MYSQL_FORMAT),
            'modified'      => ($vehicle->getModified() === null) ? null : $vehicle->format(self::MYSQL_FORMAT)
        );
    }

    public function hydrate(array $data, $vehicle)
    {
        $vehicle->setVehicleId((int) $data['vehicle_id'])
                ->setType($data['type'])
                ->setVisible(((int) $data['visible'] === 1) ? true : false)
                ->setSold(((int) $data['sold'] === 1) ? true : false)
                ->setUrl($data['url'])
                ->setPrice((int) $data['price'])
                ->setMetaKeywords($data['meta_keywords'])
                ->setMetaDesc($data['meta_desc'])
                ->setPageTitle($data['page_title'])
                ->setMarkdown($data['markdown'])
                ->setPageHtml($data['page_html'])
                ->setCreated(\DateTime::createFromFormat(self::MYSQL_FORMAT,
                                                         $data['created'],
                                                         $this->utcTimeZone))
                ->setModified(\DateTime::createFromFormat(self::MYSQL_FORMAT,
                                                          $data['modified'],
                                                          $this->utcTimeZone));
        return $vehicle;
    }
}
