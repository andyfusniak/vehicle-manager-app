<?php
namespace Vm\Hydrator;

use Nitrogen\Hydrator\AbstractFormHydrator;

use Vm\Entity\Collection;

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
