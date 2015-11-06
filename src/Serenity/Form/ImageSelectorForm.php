<?php
namespace Serenity\Form;

use Nitrogen\Form\Form;
use Nitrogen\Form\Element;

use Serenity\Service\CollectionService;

class ImageSelectorForm extends Form
{
    public function __construct(CollectionService $collectionService)
    {
        $collections = $collectionService->selectBoxCollections();
        $collectionId = new Element\Select('collection-id');
        $collectionId->setValueOptions($collections);

        $this->add([
           $collectionId
        ]);
    }
}
