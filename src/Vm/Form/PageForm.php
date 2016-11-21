<?php
namespace Vm\Form;

use Nitrogen\Form\Form;
use Nitrogen\Form\Element;
use Nitrogen\ServiceManager\HelperPluginManager;
use Nitrogen\Validator\ValidatorChain;

use Vm\Validator\PageUrlTakenValidator;
use Vm\Service\PageService;

class PageForm extends Form
{
    public function __construct(HelperPluginManager $helperPluginManager,
                                PageUrlTakenValidator $pageUrlTakenValidator,
                                PageService $pageService)
    {
        // page-id
        $pageId = new Element\Hidden('page-id');

        // url
        $url = new Element\Text('url');
        $urlChain = new ValidatorChain($helperPluginManager);
        $urlChain->attach('validatornotempty')
                 ->attach($pageUrlTakenValidator);
        $url->setValidatorChain($urlChain);

        // layout-position
        $layoutPosition = new Element\Select('layout-position');
        $layoutPosition->setValueOptions($pageService->selectBoxLayoutPositions())
                       ->setEmptyOption('--select--');
        $layoutPositionChain = new ValidatorChain($helperPluginManager);
        $layoutPositionChain->attach('validatornotempty');
        $layoutPosition->setValidatorChain($layoutPositionChain);

        // name
        $name = new Element\Text('name');
        $nameChain = new ValidatorChain($helperPluginManager);
        $nameChain->attach('validatornotempty');

        // meta-keywords
        $metaKeywords = new Element\Textarea('meta-keywords');

        // meta-desc
        $metaDesc = new Element\Textarea('meta-desc');

        // page-title
        $pageTitle = new Element\Text('page-title');

        // markdown
        $markdown = new Element\Textarea('markdown');

        $this->add([
            $pageId,
            $url,
            $layoutPosition,
            $name,
            $metaKeywords,
            $metaDesc,
            $pageTitle,
            $markdown
        ]);
    }
}
