<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

/**
 * Site interface
 */
interface SiteInterface
{

    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set permalink
     *
     * @param string $permalink
     *
     * @return SiteInterface
     */
    public function setPermalink($permalink);

    /**
     * Get permalink
     *
     * @return string
     */
    public function getPermalink();

    /**
     * Set title
     *
     * @param string $title
     *
     * @return SiteInterface
     */
    public function setTitle($title);

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return SiteInterface
     */
    public function setIsActive($isActive);

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive();

    /**
     * Set homepage
     *
     * @param PageInterface $homepage
     *
     * @return SiteInterface
     */
    public function setHomepage(PageInterface $homepage = null);

    /**
     * Get homepage
     *
     * @return PageInterface
     */
    public function getHomepage();

    /**
     * Add user
     *
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     *
     * @return SiteInterface
     */
    public function addUser(\Symfony\Component\Security\Core\User\UserInterface $user);

    /**
     * Remove user
     *
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     */
    public function removeUser(\Symfony\Component\Security\Core\User\UserInterface $user);

    /**
     * Get users
     *
     * @param \Doctrine\Common\Collections\Collection $users
     *
     * @return SiteInterface
     */
    public function setUsers(\Doctrine\Common\Collections\Collection $users);

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers();

    /**
     * Site title
     *
     * @return string
     */
    public function __toString();
}
