<?php
namespace Nitrogen\Hydrator;

interface HydratorInterface
{
    /**
     * Hydrate $object with the give $data
     *
     * @param array $data
     * @param object $obj
     */
    public function hydrate(array $data, $obj);

    /**
     * Extract data from an object
     *
     * @param object $obj
     * @return array
     */
    public function extract($obj);
}
