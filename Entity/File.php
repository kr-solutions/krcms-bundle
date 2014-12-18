<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

use DateTime;
use KRSolutions\Bundle\KRUserBundle\Entity\User;


/**
 * File
 */
class File
{

	/**
	 * @var integer
	 */
	private $id;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var DateTime
	 */
	private $createdAt;

	/**
	 * @var DateTime
	 */
	private $updatedAt;

	/**
	 * @var string
	 */
	private $uri;

	/**
	 * @var string
	 */
	private $title;

	/**
	 * @var string
	 */
	private $description;

	/**
	 * @var integer
	 */
	private $orderId;

	/**
	 * @var User
	 */
	private $createdBy;

	/**
	 * @var User
	 */
	private $updatedBy;

	/**
	 * @var Page
	 */
	private $page;

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
	 * Set name
	 *
	 * @param string $name
	 *
	 * @return File
	 */
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set createdAt
	 *
	 * @param DateTime $createdAt
	 *
	 * @return File
	 */
	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;

		return $this;
	}

	/**
	 * Get createdAt
	 *
	 * @return DateTime
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	/**
	 * Set updatedAt
	 *
	 * @param DateTime $updatedAt
	 *
	 * @return File
	 */
	public function setUpdatedAt($updatedAt)
	{
		$this->updatedAt = $updatedAt;

		return $this;
	}

	/**
	 * Get updatedAt
	 *
	 * @return DateTime
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}

	/**
	 * Set uri
	 *
	 * @param string $uri
	 *
	 * @return File
	 */
	public function setUri($uri)
	{
		$this->uri = $uri;

		return $this;
	}

	/**
	 * Get uri
	 *
	 * @return string
	 */
	public function getUri()
	{
		return $this->uri;
	}

	/**
	 * Set title
	 *
	 * @param string $title
	 *
	 * @return File
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
	 * Set description
	 *
	 * @param string $description
	 *
	 * @return File
	 */
	public function setDescription($description)
	{
		$this->description = $description;

		return $this;
	}

	/**
	 * Get description
	 *
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Set orderId
	 *
	 * @param integer $orderId
	 *
	 * @return File
	 */
	public function setOrderId($orderId)
	{
		$this->orderId = $orderId;

		return $this;
	}

	/**
	 * Get orderId
	 *
	 * @return integer
	 */
	public function getOrderId()
	{
		return $this->orderId;
	}

	/**
	 * Set createdBy
	 *
	 * @param User $createdBy
	 *
	 * @return File
	 */
	public function setCreatedBy(User $createdBy = null)
	{
		$this->createdBy = $createdBy;

		return $this;
	}

	/**
	 * Get createdBy
	 *
	 * @return User
	 */
	public function getCreatedBy()
	{
		return $this->createdBy;
	}

	/**
	 * Set updatedBy
	 *
	 * @param User $updatedBy
	 *
	 * @return File
	 */
	public function setUpdatedBy(User $updatedBy = null)
	{
		$this->updatedBy = $updatedBy;

		return $this;
	}

	/**
	 * Get updatedBy
	 *
	 * @return User
	 */
	public function getUpdatedBy()
	{
		return $this->updatedBy;
	}

	/**
	 * Set page
	 *
	 * @param Page $page
	 *
	 * @return File
	 */
	public function setPage(Page $page = null)
	{
		$this->page = $page;

		return $this;
	}

	/**
	 * Get page
	 *
	 * @return Page
	 */
	public function getPage()
	{
		return $this->page;
	}

	/**
	 * File title
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->title;
	}

}
