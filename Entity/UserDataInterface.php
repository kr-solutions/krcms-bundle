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
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\UserInterface $user
	 *
	 * @return UserDataInterface
	 */
	public function setUser(UserInterface $user);

	/**
	 * Get user
	 *
	 * @return UserInterface
	 */
	public function getUser();

	/**
	 * Set last selected site
	 *
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\SiteInterface $lastSelectedSite
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
