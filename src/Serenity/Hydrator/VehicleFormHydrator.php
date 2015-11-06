<?php
namespace Serenity\Hydrator;

use Nitrogen\Hydrator\AbstractFormHydrator;

use Serenity\Entity\Vehicle;

class VehicleFormHydrator extends AbstractFormHydrator
{
    public function extract($object)
    {
        return [
            'vehicle-id' => (string) $object->getVehicleId(),
            'type'       => $object->getType(),
            'visible'    => ($object->getVisible() === true) ? '1' : '0',
            'sold'       => ($object->getSold() === true) ? '1' : '0',
            'new'        => ($object->getNew() === true ? '1' : '0'),
            'featured'   => ($object->getFeatured() === true ? '1' : '0'),
            'url'        => ($object->getUrl() === null) ? '' : $object->getUrl(),
            'price'      => ($object->getPrice() === null) ? '': (string) $object->getPrice(),
            'meta-keywords' => ($object->getMetaKeywords() === null) ? '' : $object->getMetaKeywords(),
            'meta-desc'  => ($object->getMetaDesc() === null) ? '' : $object->getMetaDesc(),
            'page-title' => ($object->getPageTitle() === null) ? '' : $object->getPageTitle(),
            'collection-id' => ($object->getCollectionId() === null) ? '' : $object->getCollectionId(),
            'markdown'   => ($object->getMarkdown() === null) ? '' : $object->getMarkdown(),
            'page-html'  => ($object->getPageHtml() === null) ? '' : $object->getPageHtml(),
            'features'   => $object->getFeatures()
        ];
    }

    public function hydrate(array $data, $object)
    {
        $object->setVehicleId($data['vehicle-id'])
               ->setType($data['type'])
               ->setVisible(($data['visible'] === '1') ? true : false)
               ->setSold(($data['sold'] === '1') ? true : false)
               ->setNew(($data['new'] === '1' ? true : false))
               ->setUrl($data['url'])
               ->setPrice((int) $data['price'])
               ->setMetaKeywords($data['meta-keywords'])
               ->setMetaDesc($data['meta-desc'])
               ->setPageTitle($data['page-title'])
               ->setCollectionId($data['collection-id'])
               ->setMarkdown($data['markdown'])
               ->setPageHtml(isset($data['page-html']) ? $data['page-html'] : null)
               ->setFeatures(isset($data['features']) ? $data['features'] : []);
        return $object;
    }
}
