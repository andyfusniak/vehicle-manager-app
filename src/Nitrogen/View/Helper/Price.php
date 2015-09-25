<?php
namespace Nitrogen\View\Helper;

class Price extends AbstractHelper
{
    const GBP = 'GBP';
    const USD = 'USD';

    /**
     * @param mixed $value to display
     * @param string|null $currencyCode iso4217 currency code
     * @param array|null options
     */
    public function __invoke($value, $currencyCode = self::GBP, $options = null)
    {
        switch ($currencyCode) {
        case self::GBP:
            return '&pound;' . number_format($value, isset($options['decimal_places']) ? $options['decimal_places'] : 2, '.', ',');
            break;
        }

        throw \Exception(sprintf(
            '%s does not yet support displaying of %s',
            __METHOD__,
            $currency
        ));
    }
}
