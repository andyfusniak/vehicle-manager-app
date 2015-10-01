<?php
namespace Serenity\Service;

use Symfony\Component\HttpFoundation\Session\Session;

use Serenity\Mapper\AdminMapper;
use Serenity\Entity\Admin;

class AuthService
{
    /**
     * @var AdminMapper
     */
    protected $mapper;

    /**
     * @var Session
     */
    protected $session;

    public function __construct(AdminMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function validateLogin($username, $passwd)
    {
        $admin = $this->mapper->fetchByUsername($username);

        if (($admin !== null) && (password_verify($passwd, $admin->getPasswd()))) {
            return $admin;
        }

        return null;
    }

    public function addAdministrator(Admin $admin)
    {
        return $this->mapper->insert($admin);
    }

    public function login(Admin $admin)
    {
        if ($this->session === null) {
            $this->session = new Session();
        }

        //$this->session->start();
        $this->session->set('admin', $admin);
    }

    public function logout()
    {
        if ($this->session === null) {
            $this->session = new Session();
        }

        $this->session->clear();
    }
}
