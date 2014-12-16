<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


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
	private $template;

	/**
	 * @var string
	 */
	private $title;

	/**
	 * @var string
	 */
	private $siteUrl;

	/**
	 * @var \DateTime
	 */
	private $createdAt;

	/**
	 * @var \DateTime
	 */
	private $updatedAt;

	/**
	 * @var boolean
	 */
	private $isActive;

	/**
	 * @var \KRSolutions\Bundle\KRCMSBundle\Entity\User
	 */
	private $createdBy;

	/**
	 * @var \KRSolutions\Bundle\KRCMSBundle\Entity\User
	 */
	private $updatedBy;

	/**
	 * @var \KRSolutions\Bundle\KRCMSBundle\Entity\Page
	 */
	private $homepage;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $users;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->users = new \Doctrine\Common\Collections\ArrayCollection();
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
	 * Set template
	 *
	 * @param string $template
	 *
	 * @return Site
	 */
	public function setTemplate($template)
	{
		$this->template = $template;

		return $this;
	}

	/**
	 * Get template
	 *
	 * @return string
	 */
	public function getTemplate()
	{
		return $this->template;
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
	 * Set createdAt
	 *
	 * @param \DateTime $createdAt
	 *
	 * @return Site
	 */
	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;

		return $this;
	}

	/**
	 * Get createdAt
	 *
	 * @return \DateTime
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	/**
	 * Set updatedAt
	 *
	 * @param \DateTime $updatedAt
	 *
	 * @return Site
	 */
	public function setUpdatedAt($updatedAt)
	{
		$this->updatedAt = $updatedAt;

		return $this;
	}

	/**
	 * Get updatedAt
	 *
	 * @return \DateTime
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
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
	 * Set createdBy
	 *
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\User $createdBy
	 *
	 * @return Site
	 */
	public function setCreatedBy(\KRSolutions\Bundle\KRCMSBundle\Entity\User $createdBy = null)
	{
		$this->createdBy = $createdBy;

		return $this;
	}

	/**
	 * Get createdBy
	 *
	 * @return \KRSolutions\Bundle\KRCMSBundle\Entity\User
	 */
	public function getCreatedBy()
	{
		return $this->createdBy;
	}

	/**
	 * Set updatedBy
	 *
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\User $updatedBy
	 *
	 * @return Site
	 */
	public function setUpdatedBy(\KRSolutions\Bundle\KRCMSBundle\Entity\User $updatedBy = null)
	{
		$this->updatedBy = $updatedBy;

		return $this;
	}

	/**
	 * Get updatedBy
	 *
	 * @return \KRSolutions\Bundle\KRCMSBundle\Entity\User
	 */
	public function getUpdatedBy()
	{
		return $this->updatedBy;
	}

	/**
	 * Set homepage
	 *
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\Page $homepage
	 *
	 * @return Site
	 */
	public function setHomepage(\KRSolutions\Bundle\KRCMSBundle\Entity\Page $homepage = null)
	{
		$this->homepage = $homepage;

		return $this;
	}

	/**
	 * Get homepage
	 *
	 * @return \KRSolutions\Bundle\KRCMSBundle\Entity\Page
	 */
	public function getHomepage()
	{
		return $this->homepage;
	}

	/**
	 * Add user
	 *
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\User $user
	 *
	 * @return Site
	 */
	public function addUser(\KRSolutions\Bundle\KRCMSBundle\Entity\User $user)
	{
		$this->users[] = $user;

		return $this;
	}

	/**
	 * Remove user
	 *
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\User $user
	 */
	public function removeUser(\KRSolutions\Bundle\KRCMSBundle\Entity\User $user)
	{
		$this->users->removeElement($user);
	}

	/**
	 * Get users
	 *
	 * @return \Doctrine\Common\Collections\Collection
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
