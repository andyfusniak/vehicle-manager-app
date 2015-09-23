<?php
namespace Serenity\Hydrator;

use Nitrogen\Hydrator\AbstractFormHydrator;

use Serenity\Entity\Collection;

class CollectionFormHydrator extends AbstractFormHydrator
{
    public function extract($object)
    {
        // TODO
        return [];
    }

    public function hydrate(array $data, $object)
    {
        $object->setCollectionId((int) $data['collection-id'])
               ->setTagname($data['tagname'])
               ->setName($data['name']);
        return $object;
    }
}
