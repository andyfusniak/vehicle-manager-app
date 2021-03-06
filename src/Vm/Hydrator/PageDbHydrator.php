<?php
namespace Vm\Hydrator;

use Nitrogen\Hydrator\AbstractDbHydrator;
use Vm\Entity\Page;

class PageDbHydrator extends AbstractDbHydrator
{
    public function extract($object)
    {
        if (!$object instanceof Page) {
            throw new \InvalidArgumentException(sprintf(
                '%s: expects an instance of Page; received "%s"',
                __METHOD__,
                (is_object($object) ? get_class($object) : gettype($object))
            ));
        }

        return [
            'page_id'         => $object->getPageId(),
            'layout_position' => $object->getLayoutPosition(),
            'url'             => $object->getUrl(),
            'name'            => $object->getName(),
            'meta_keywords'   => $object->getMetaKeywords(),
            'meta_desc'       => $object->getMetaDesc(),
            'page_title'      => $object->getPageTitle(),
            'markdown'        => $object->getMarkdown(),
            'page_html'       => $object->getPageHtml(),
            'created'         => $object->getCreated(),
            'modified'        => $object->getModified()
        ];
    }

    public function hydrate(array $data, $object)
    {
        $object->setPageId((int) $data['page_id'])
               ->setLayoutPosition($data['layout_position'])
               ->setUrl($data['url'])
               ->setName($data['name'])
               ->setMetaKeywords($data['meta_keywords'])
               ->setMetaDesc($data['meta_desc'])
               ->setPageTitle($data['page_title'])
               ->setMarkdown($data['markdown'])
               ->setPageHtml($data['page_html'])
               ->setCreated($this->mysqlTimeStampToDateTime($data['created']))
               ->setModified($this->mysqlTimeStampToDateTime($data['modified']));
        return $object;
    }
}
