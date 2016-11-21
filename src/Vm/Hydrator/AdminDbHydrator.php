<?php
namespace Vm\Hydrator;

use Nitrogen\Hydrator\AbstractDbHydrator;
use Vm\Entity\Admin;

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
            'created'  => ($admin->getCreated() === null) ? null : $admin->getCreated()->format(self::MYSQL_FORMAT),
            'modified' => ($admin->getModified() === null) ? null : $admin->getModified()->format(self::MYSQL_FORMAT)
        );
    }

    public function hydrate(array $data, $object)
    {
        $object->setAdminId((int) $data['admin_id'])
               ->setUsername($data['username'])
               ->setPasswd($data['passwd'])
               ->setCreated($this->mysqlTimeStampToDateTime($data['created']))
               ->setModified($this->mysqlTimeStampToDateTime($data['modified']));
        return $object;
    }
}
