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
	 * @param UserInterface $user
	 *
	 * @return SiteInterface
	 */
	public function addUser(UserInterface $user);

	/**
	 * Remove user
	 *
	 * @param UserInterface $user
	 */
	public function removeUser(UserInterface $user);

	/**
	 * Get users
	 *
	 * @return Collection
	 */
	public function getUsers();

	/**
	 * Site title
	 *
	 * @return string
	 */
	public function __toString();
}
