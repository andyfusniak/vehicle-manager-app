<?php
namespace Vm\Hydrator;

use Nitrogen\Hydrator\AbstractDbHydrator;
use Vm\Entity\Vehicle;

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

        $featureList = [];
        foreach ($vehicle->getFeatures() as $feature) {
            $featureList[$feature] = true;
        }

        return [
            'vehicle_id'    => $vehicle->getVehicleId(),
            'type'          => $vehicle->getType(),
            'visible'       => ($vehicle->getVisible() === true) ? 1 : 0,
            'sold'          => ($vehicle->getSold() === true) ? 1 : 0,
            'new'           => ($vehicle->getNew() === true) ? 1 : 0,
            'featured'      => ($vehicle->getFeatured() === true) ? 1 : 0,
            'url'           => $vehicle->getUrl(),
            'price'         => $vehicle->getPrice(),
            'meta_keywords' => $vehicle->getMetaKeywords(),
            'meta_desc'     => $vehicle->getMetaDesc(),
            'page_title'    => $vehicle->getPageTitle(),
            'collection_id' => $vehicle->getCollectionId(),
            'markdown'      => $vehicle->getMarkdown(),
            'page_html'     => $vehicle->getPageHtml(),
            'features'      => json_encode($featureList),
            'created'       => ($vehicle->getCreated() === null) ? null : $vehicle->getCreated()->format(self::MYSQL_FORMAT),
            'modified'      => ($vehicle->getModified() === null) ? null : $vehicle->format(self::MYSQL_FORMAT)
        ];
    }

    public function hydrate(array $data, $vehicle)
    {
        if (isset($data['features']) && (!empty($data['features']))) {
            $features = array_keys(json_decode($data['features'], true));
        } else {
            $features = [];
        }

        $vehicle->setVehicleId((int) $data['vehicle_id'])
                ->setType($data['type'])
                ->setVisible(((int) $data['visible'] === 1) ? true : false)
                ->setSold(((int) $data['sold'] === 1) ? true : false)
                ->setNew((int) $data['new'] === 1 ? true : false)
                ->setFeatured((int) $data['featured'] === 1 ? true : false)
                ->setUrl(($data['url'] === null) ? '' : $data['url'])
                ->setPrice((int) $data['price'])
                ->setMetaKeywords(($data['meta_keywords'] === null) ? '' : $data['meta_keywords'])
                ->setMetaDesc(($data['meta_desc'] === null) ? '' : $data['meta_desc'])
                ->setPageTitle(($data['page_title'] === null) ? '' : $data['page_title'])
                ->setCollectionId($data['collection_id'])
                ->setMarkdown(($data['markdown'] === null) ? '' : $data['markdown'])
                ->setPageHtml(($data['page_html'] === null) ? '' : $data['page_html'])
                ->setFeatures($features)
                ->setCreated($this->mysqlTimeStampToDateTime($data['created']))
                ->setModified($this->mysqlTimeStampToDateTime($data['modified']));
        return $vehicle;
    }
}
