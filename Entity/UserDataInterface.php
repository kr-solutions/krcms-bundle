<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

/**
 * User data interface
 */
interface UserDataInterface
{

    /**
     * Get id
     *
     * @return id
     */
    public function getId();

    /**
     * Set user
     *
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     *
     * @return UserDataInterface
     */
    public function setUser(\Symfony\Component\Security\Core\User\UserInterface $user);

    /**
     * Get user
     *
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function getUser();

    /**
     * Set last selected site
     *
     * @param SiteInterface $lastSelectedSite
     *
     * @return UserDataInterface
     */
    public function setLastSelectedSite(SiteInterface $lastSelectedSite = null);

    /**
     * Get last selected site
     *
     * @return SiteInterface
     */
    public function getLastSelectedSite();
}
