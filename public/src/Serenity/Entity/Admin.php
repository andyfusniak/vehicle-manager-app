<?php
namespace Serenity\Entity;

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
     * @var \DateTime created datetime object
     */
    protected $created;
   
    /**
     * @var \DateTime
     */
    protected $modified;

    public function setAdminId($adminId)
    {
        $this->adminId = $adminId;
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
