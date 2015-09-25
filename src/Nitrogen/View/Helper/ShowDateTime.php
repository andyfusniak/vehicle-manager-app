<?php
namespace Nitrogen\View\Helper;

class ShowDateTime extends AbstractHelper
{
    const DEFAULT_DATE_UK = 'd/m/y';
    const DEFAULT_TIME_UK = 'g:ia';
    const DEFAULT_DATETIME_UK = 'd/m/y g:ia';

    public function __invoke($value, $timeZone = null)
    {
        if (($timeZone !== null) && is_string($timeZone)) {
            $timeZone = new \DateTimeZone($timeZone);
        }

        if ($value instanceof \DateTime) {
            if ($timeZone instanceof \DateTimeZone) {
                $value->setTimezone($timeZone);
            }

            // make times align
            // e.g.  25/09/15 12:22pm
            //       25/09/15  1:22pm

            //if (strlen($value->format('g')) > 1) {
            //    $spacing = '&nbsp;';
            //} else {
            //    $spacing = '&nbsp;&nbsp;';
            //}

            return $value->format(self::DEFAULT_DATETIME_UK);
        }
        return 'NO';
    }
}
