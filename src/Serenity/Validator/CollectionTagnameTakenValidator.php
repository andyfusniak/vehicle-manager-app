<?php
namespace Serenity\Validator;

use Nitrogen\Validator\AbstractValidator;
use Nitrogen\Validator\Exception;
use Serenity\Service\CollectionService;

class CollectionTagnameTakenValidator extends AbstractValidator
{
    const COLLECTION_TAGNAME_TAKEN = 'collectionTagnameTaken';

    /**
     * @var CollectionService
     */
    protected $service;

    /**
     * @param CollectionService $collectionService
     */
    public function __construct(CollectionService $service)
    {
        $this->service = $service;
    }

    /**
     * @param string $value to validate
     * @return bool true or false
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

        if ($this->service->isTagnameTaken($value)) {
            $this->messages[self::COLLECTION_TAGNAME_TAKEN] = 'This tagname is already in use';
            return false;
        }
        return true;
    }
}
