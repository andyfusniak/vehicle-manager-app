<?php
namespace Serenity\Hydrator;

use Nitrogen\Hydrator\AbstractDbHydrator;
use Serenity\Entity\Collection;

class CollectionDbHydrator extends AbstractDbHydrator
{
    public function extract($object)
    {
        if (!$object instanceof Collection) {
            throw new \InvalidArgumentException(sprintf(
                '%s: expects an instance of Collection; received "%s"',
                __METHOD__,
                (is_object($object) ? get_class($object) : gettype($object))
            ));
        }

        return [
            'collection_id' => $object->getCollectionId(),
            'tagname'       => $object->getTagname(),
            'name'          => $object->getName(),
            'created'       => ($object->getCreated() === null) ? null : $object->getCreated()->format(self::MYSQL_FORMAT),
            'modified'      => ($object->getModified() === null) ? null : $object->getModified()->format(self::MYSQL_FORMAT)
        ];
    }

    public function hydrate(array $data, $object)
    {
        $object->setCollectionId((int) $data['collection_id'])
               ->setTagname($data['tagname'])
               ->setName($data['name'])
               ->setCreated($this->mysqlTimeStampToDateTime($data['created']))
               ->setModified($this->mysqlTimeStampToDateTime($data['modified']));
        return $object;
    }
}
