<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;


/**
 * File
 */
class File implements FileInterface
{

	/**
	 * @var integer
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var \DateTime
	 */
	protected $createdAt;

	/**
	 * @var \DateTime
	 */
	protected $updatedAt;

	/**
	 * @var string
	 */
	protected $uri;

	/**
	 * @var string
	 */
	protected $title;

	/**
	 * @var string
	 */
	protected $description;

	/**
	 * @var PageInterface
	 */
	protected $page;

	/**
	 * @var integer
	 */
	protected $orderId;

	/**
	 * File constructor
	 */
	public function __construct()
	{
		$this->createdAt = new \DateTime('now');
		$this->updatedAt = new \DateTime('now');
		$this->orderId = 0;
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
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * {@inheritDoc}
	 */
	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;

		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	/**
	 * {@inheritDoc}
	 */
	public function setUpdatedAt($updatedAt)
	{
		$this->updatedAt = $updatedAt;

		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}

	/**
	 * {@inheritDoc}
	 */
	public function setUri($uri)
	{
		$this->uri = $uri;

		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getUri()
	{
		return $this->uri;
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
	public function setDescription($description)
	{
		$this->description = $description;

		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * {@inheritDoc}
	 */
	public function setPage(PageInterface $page)
	{
		$this->page = $page;

		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getPage()
	{
		return $this->page;
	}

	/**
	 * {@inheritDoc}
	 */
	public function setOrderId($orderId)
	{
		$this->orderId = $orderId;

		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getOrderId()
	{
		return $this->orderId;
	}

	/**
	 * {@inheritDoc}
	 */
	public function __toString()
	{
		return $this->title;
	}

}
