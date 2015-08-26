<?php
namespace Serenity\Hydrator;

use Serenity\Entity\Admin;

class AdminDbHydrator
{
    // 2015-08-25 14:01:28
    const MYSQL_FORMAT = 'Y-m-d H:i:s';

    public function extract(Admin $admin)
    {
        return array(
            'admin_id' => (int) $admin->getAdminId(),
            'username' => (string) $admin->getUsername(),
            'created'  => $admin->getCreated()->format(self::MYSQL_FORMAT),
            'modified' => $admin->getModified()->format(self::MYSQL_FORMAT)
        );
    }
}
