<?php
namespace Serenity\Hydrator;

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
            'admin_id' => (int) $admin->getAdminId(),
            'username' => (string) $admin->getUsername(),
            'passwd'   => (string) $admin->getPasswd(),
            'created'  => $admin->getCreated()->format(self::MYSQL_FORMAT),
            'modified' => $admin->getModified()->format(self::MYSQL_FORMAT)
        );
    }

    public function hydrate(array $data, $object)
    {
    }
}
