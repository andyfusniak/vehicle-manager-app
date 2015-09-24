<?php
namespace Serenity\Form;

use Nitrogen\Form\Form;
use Nitrogen\Form\Element;
use Nitrogen\ServiceManager\HelperPluginManager;
use Nitrogen\Validator\ValidatorChain;

use Serenity\Validator\PageUrlTakenValidator;

class PageForm extends Form
{
    public function __construct(HelperPluginManager $helperPluginManager,
                                PageUrlTakenValidator $pageUrlTakenValidator)
    {
        // page-id
        $pageId = new Element\Hidden('page-id');

        // url
        $url = new Element\Text('url');
        $urlChain = new ValidatorChain($helperPluginManager);
        $urlChain->attach('validatornotempty')
                 ->attach($pageUrlTakenValidator);
        $url->setValidatorChain($urlChain);

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
            $metaKeywords,
            $metaDesc,
            $pageTitle,
            $markdown
        ]);
    }
}
