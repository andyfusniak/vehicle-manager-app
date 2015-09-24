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
    public function isValid($value)
    {
        if (!is_string($value)) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s expects a string value',
                __METHOD__
            ));
        }

        $this->setValue($value);

        if ($this->service->isUrlTaken($value)) {
            $this->messages[self::PAGE_URL_TAKEN] = 'The page url chosen is already in use';
            return false;
        }
        return true;
    }
}
