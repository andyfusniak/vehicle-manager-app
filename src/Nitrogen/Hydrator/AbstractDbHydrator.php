<?php
namespace Serenity\Hydrator;

abstract class AbstractDbHydrator implements HydratorInterface
{
    const MYSQL_FORMAT = 'Y-m-d H:i:s';

    protected $utcTimeZone;

    public function __construct()
    {
        $this->utcTimeZone = new \DateTimeZone('UTC');
    }
}
