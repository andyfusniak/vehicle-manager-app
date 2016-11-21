<?php
namespace Vm\Hydrator;

use Nitrogen\Hydrator\AbstractFormHydrator;

use Vm\Entity\Page;

class PageFormHydrator extends AbstractFormHydrator
{
    public function extract($object)
    {
        return [
            'page-id'         => (string) $object->getPageId(),
            'layout-position' => $object->getLayoutPosition(),
            'url'             => $object->getUrl(),
            'name'            => $object->getName(),
            'meta-keywords'   => $object->getMetaKeywords(),
            'meta-desc'       => $object->getMetaDesc(),
            'page-title'      => $object->getPageTitle(),
            'markdown'        => $object->getMarkdown(),
            'page-html'       => $object->getPageHtml(),
            'created'         => $object->getCreated()->format('Y-m-d H:i:s'),
            'modified'        => $object->getModified()->format('Y-m-d H:i:s')
        ];
    }

    public function hydrate(array $data, $object)
    {
        if (isset($data['page-id'])) {
            $pageId = ($data['page-id'] === '') ? null : (int) $data['page-id'];
        } else {
            $pageId = null;
        }
        $object->setPageId($pageId)
               ->setLayoutPosition($data['layout-position'])
               ->setUrl($data['url'])
               ->setName($data['name'])
               ->setMetaKeywords($data['meta-keywords'])
               ->setMetaDesc($data['meta-desc'])
               ->setPageTitle($data['page-title'])
               ->setMarkdown($data['markdown'])
               ->setPageHtml(isset($data['page-html']) ? $data['page-html'] : null);
        // created and modified not converted
        return $object;
    }
}
