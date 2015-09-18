<?php
namespace Serenity\Hydrator;

use Nitrogen\Hydrator\AbstractDbHydrator;
use Serenity\Entity\Admin;

class AdminDbHydrator extends AbstractDbHydrator
{
    public function extract($admin)
    {
        if (!$admin instanceof Admin) {
            throw new \InvalidArgumentException(sprintf(
                '%s: expects an instance of Admin; received "%s"',
                __METHOD__,
                (is_object($admin) ? get_class($admin) : gettype($admin))
            ));
        }

        return array(
            'admin_id' => $admin->getAdminId(),
            'username' => $admin->getUsername(),
            'passwd'   => $admin->getPasswd(),
            'created'  => $admin->getCreated()->format(self::MYSQL_FORMAT),
            'modified' => $admin->getModified()->format(self::MYSQL_FORMAT)
        );
    }

    public function hydrate(array $data, $object)
    {
    }
}
