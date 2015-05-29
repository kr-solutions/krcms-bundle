<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 */
class User extends BaseUser implements UserInterface
{

    protected $id;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function getKRCMSUsername()
    {
        return $this->email;
    }
}
