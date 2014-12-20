<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use KRSolutions\Bundle\KRUserBundle\Entity\User;


/**
 * Site
 */
class Site
{

	/**
	 * @var integer
	 */
	private $id;

	/**
	 * @var string
	 */
	private $permalink;

	/**
	 * @var string
	 */
	private $title;

	/**
	 * @var string
	 */
	private $siteUrl;

	/**
	 * @var boolean
	 */
	private $isActive;

	/**
	 * @var Page
	 */
	private $homepage;

	/**
	 * @var Collection
	 */
	private $users;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->users = new ArrayCollection();
	}

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set permalink
	 *
	 * @param string $permalink
	 *
	 * @return Site
	 */
	public function setPermalink($permalink)
	{
		$this->permalink = $permalink;

		return $this;
	}

	/**
	 * Get permalink
	 *
	 * @return string
	 */
	public function getPermalink()
	{
		return $this->permalink;
	}

	/**
	 * Set title
	 *
	 * @param string $title
	 *
	 * @return Site
	 */
	public function setTitle($title)
	{
		$this->title = $title;

		return $this;
	}

	/**
	 * Get title
	 *
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Set siteUrl
	 *
	 * @param string $siteUrl
	 *
	 * @return Site
	 */
	public function setSiteUrl($siteUrl)
	{
		$this->siteUrl = $siteUrl;

		return $this;
	}

	/**
	 * Get siteUrl
	 *
	 * @return string
	 */
	public function getSiteUrl()
	{
		return $this->siteUrl;
	}

	/**
	 * Set isActive
	 *
	 * @param boolean $isActive
	 *
	 * @return Site
	 */
	public function setIsActive($isActive)
	{
		$this->isActive = $isActive;

		return $this;
	}

	/**
	 * Get isActive
	 *
	 * @return boolean
	 */
	public function getIsActive()
	{
		return $this->isActive;
	}

	/**
	 * Set homepage
	 *
	 * @param Page $homepage
	 *
	 * @return Site
	 */
	public function setHomepage(Page $homepage = null)
	{
		$this->homepage = $homepage;

		return $this;
	}

	/**
	 * Get homepage
	 *
	 * @return Page
	 */
	public function getHomepage()
	{
		return $this->homepage;
	}

	/**
	 * Add user
	 *
	 * @param User $user
	 *
	 * @return Site
	 */
	public function addUser(User $user)
	{
		$this->users[] = $user;

		return $this;
	}

	/**
	 * Remove user
	 *
	 * @param User $user
	 */
	public function removeUser(User $user)
	{
		$this->users->removeElement($user);
	}

	/**
	 * Get users
	 *
	 * @return Collection
	 */
	public function getUsers()
	{
		return $this->users;
	}

	/**
	 * Site title
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->title;
	}

}
