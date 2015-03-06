<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;


/**
 * Site
 */
class Site implements SiteInterface
{

	/**
	 * @var integer
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $permalink;

	/**
	 * @var string
	 */
	protected $title;

	/**
	 * @var boolean
	 */
	protected $isActive;

	/**
	 * @var PageInterface
	 */
	protected $homepage;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 */
	protected $users;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->users = new ArrayCollection();
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
	public function setPermalink($permalink)
	{
		$this->permalink = $permalink;

		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getPermalink()
	{
		return $this->permalink;
	}

	/**
	 * {@inheritDoc}
	 */
	public function setTitle($title)
	{
		$this->title = $title;

		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * {@inheritDoc}
	 */
	public function setIsActive($isActive)
	{
		$this->isActive = $isActive;

		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getIsActive()
	{
		return $this->isActive;
	}

	/**
	 * {@inheritDoc}
	 */
	public function setHomepage(PageInterface $homepage = null)
	{
		$this->homepage = $homepage;

		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getHomepage()
	{
		return $this->homepage;
	}

	/**
	 * {@inheritDoc}
	 */
	public function addUser(\Symfony\Component\Security\Core\User\UserInterface $user)
	{
		if (!$this->users->contains($user)) {
			$this->users->add($user);
		}

		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function removeUser(\Symfony\Component\Security\Core\User\UserInterface $user)
	{
		$this->users->removeElement($user);

		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function setUsers(\Doctrine\Common\Collections\Collection $users)
	{
		$this->users = $users;

		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getUsers()
	{
		return $this->users;
	}

	/**
	 * {@inheritDoc}
	 */
	public function __toString()
	{
		return $this->title;
	}

}
