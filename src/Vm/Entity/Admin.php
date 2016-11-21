<?php
namespace Vm\Entity;

class Admin
{
    /**
     * @var int administrator unique id (primary key)
     */
    protected $adminId;

    /**
     * @var string username of the administrator
     */
    protected $username;

    /**
     * @var string passwd of the administrator
     */
    protected $passwd;

    /**
     * @var \DateTime created datetime object
     */
    protected $created;

    /**
     * @var \DateTime last modified datetime object
     */
    protected $modified;

    public function setAdminId($adminId)
    {
        $this->adminId = (int) $adminId;
        return $this;
    }

    public function getAdminId()
    {
        return $this->adminId;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setPasswd($passwd)
    {
        $this->passwd = $passwd;
        return $this;
    }

    public function getPasswd()
    {
        return $this->passwd;
    }

    /**
     * Set the created datetime
     * @param \DateTime the datetime created
     * @return Admin
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * Get the create datetime object
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set the modified datetime
     * @param DateTime the modified datetime object
     * @return Admin
     */
    public function setModified(\DateTime $modified)
    {
        $this->modified = $modified;
        return $this;
    }

    /**
     * Get the last modified datetime object
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }
}
