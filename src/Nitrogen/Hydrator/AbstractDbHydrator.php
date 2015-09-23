<?php
namespace Nitrogen\Hydrator;

abstract class AbstractDbHydrator implements HydratorInterface
{
    const MYSQL_FORMAT = 'Y-m-d H:i:s';

    protected $utcTimeZone;

    public function __construct()
    {
        $this->utcTimeZone = new \DateTimeZone('UTC');
    }

    /**
     * @param string $mysqlString mysql string format '2015-09-18 10:58:09'
     * @return \DateTime the datetime in the timezone
     */
    protected function mysqlTimeStampToDateTime($mysqlString, $timeZone = null)
    {
        if ($timeZone === null) {
            $timeZone = $this->utcTimeZone;
        }
        return \DateTime::createFromFormat(self::MYSQL_FORMAT, $mysqlString, $timeZone);
    }
}
