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
            'url'        => ($object->getUrl() === null) ? '' : $object->getUrl(),
            'price'      => ($object->getPrice() === null) ? '': (string) $object->getPrice(),
            'meta-keywords' => ($object->getMetaKeywords() === null) ? '' : $object->getMetaKeywords(),
            'meta-desc'  => ($object->getMetaDesc() === null) ? '' : $object->getMetaDesc(),
            'page-title' => ($object->getPageTitle() === null) ? '' : $object->getPageTitle(),
            'markdown'   => ($object->getMarkdown() === null) ? '' : $object->getMarkdown(),
            'page-html'  => ($object->getPageHtml() === null) ? '' : $object->getPageHtml()
        ];
    }

    public function hydrate(array $data, $object)
    {
        $object->setVehicleId($data['vehicle-id'])
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
