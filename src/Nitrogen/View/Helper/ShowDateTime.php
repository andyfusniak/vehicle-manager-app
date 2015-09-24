<?php
namespace Nitrogen\View\Helper;

class ShowDateTime extends AbstractHelper
{
    const DEFAULT_FORMAT = 'm/d/y g:ia';

    public function __invoke($value, $timeZone = null)
    {
        if (($timeZone !== null) && is_string($timeZone)) {
            $timeZone = new \DateTimeZone($timeZone);
        }

        if ($value instanceof \DateTime) {
            if ($timeZone instanceof \DateTimeZone) {
                $value->setTimezone($timeZone);
            }
            return $value->format(self::DEFAULT_FORMAT);
        }
        return 'NO';
    }
}
