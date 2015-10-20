<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

/**
 * User data
 */
class UserData implements UserDataInterface
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @var \Symfony\Component\Security\Core\User\UserInterface
     */
    protected $user;

    /**
     * @var SiteInterface
     */
    protected $lastSelectedSite;

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
    public function getLastSelectedSite()
    {
        return $this->lastSelectedSite;
    }

    /**
     * {@inheritDoc}
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * {@inheritDoc}
     */
    public function setLastSelectedSite(SiteInterface $lastSelectedSite = null)
    {
        $this->lastSelectedSite = $lastSelectedSite;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setUser(\Symfony\Component\Security\Core\User\UserInterface $user)
    {
        $this->user = $user;

        return $this;
    }
}
