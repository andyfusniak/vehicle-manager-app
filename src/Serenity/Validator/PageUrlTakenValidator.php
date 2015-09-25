<?php
namespace Serenity\Validator;

use Nitrogen\Validator\AbstractValidator;
use Nitrogen\Validator\Exception;
use Serenity\Service\PageService;

class PageUrlTakenValidator extends AbstractValidator
{
    const PAGE_URL_TAKEN = 'pageUrlTaken';

    /**
     * @var PageService
     */
    protected $service;

    /**
     * @param PageService $service
     */
    public function __construct(PageService $service)
    {
        $this->service = $service;
    }

    /**
     * @param string @value to validate
     * @return bool if it is valid returns true
     */
    public function isValid($value, $context = null)
    {
        if (!is_string($value)) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s expects a string value',
                __METHOD__
            ));
        }

        // if the 'page-id' form data is set, we must be editing
        // so we check the url in the context of updating the form
        // i.e. we don't check the url for the current page's url
        if (empty($context['page-id'])) {
            $pageId = null;
        } else {
            $pageId = (int) $context['page-id'];
        }

        $this->setValue($value);

        if ($this->service->isUrlTaken($value, $pageId)) {
            $this->messages[self::PAGE_URL_TAKEN] = 'The page url chosen is already in use';
            return false;
        }
        return true;
    }
}
