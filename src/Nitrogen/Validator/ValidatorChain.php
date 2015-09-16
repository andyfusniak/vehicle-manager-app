<?php
namespace Nitrogen\Validator;

use Nitrogen\Validator\ValidatorInterface;
use Nitrogen\ServiceManager\HelperPluginManager;

class ValidatorChain implements ValidatorInterface
{
    /**
     * @var array of Validator objects
     */
    protected $validators = [];

    /**
     * @var array|null
     */
    protected $messages;

    /**
     * @var HelperPluginManager
     */
    protected $helperPluginManager;

    /**
     * @param string|ValidatorInterface validator string for plugin manager or validator object
     * @return ValidatorChain
     */
    public function attach($validator)
    {
        if (is_string($validator)) {
            $object = $this->helperPluginManager->get($validator);
            if ($object === null) {
                throw new \Exception(sprintf(
                    '%s failed to load validator plugin "%s"',
                    __METHOD__,
                    $validator
                ));
            }
            $this->attach($object);
        } else if ($validator instanceof ValidatorInterface) {
            $this->validators[] = $validator;
        } else {
            throw new \Exception(sprintf(
                '%s expects a string validator plugin or ValidatorInterface object',
                __METHOD__
            ));
        }
        return $this;
    }

    public function isValid($value)
    {
        $this->messages = [];
        $result = true;

        foreach ($this->validators as $validator) {
            if (!$validator->isValid($value)) {
                $result = false;
                $this->messages = array_replace_recursive(
                    $this->messages,
                    $validator->getMessages()
                );
            }
        }
        return $result;
    }

    public function getMessages()
    {
        return $this->messages;
    }

    public function setHelperPluginManager(HelperPluginManager $helperPluginManager)
    {
        $this->helperPluginManager = $helperPluginManager;
        return $this;
    }
}
