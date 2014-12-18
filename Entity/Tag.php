<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


/**
 * Tag
 */
class Tag
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
	 * @var Collection
	 */
	private $pages;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->pages = new ArrayCollection();
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
	 * Set name
	 *
	 * @param string $name
	 *
	 * @return Tag
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
	 * Add page
	 *
	 * @param Page $page
	 *
	 * @return Tag
	 */
	public function addPage(Page $page)
	{
		$this->pages[] = $page;

		return $this;
	}

	/**
	 * Remove page
	 *
	 * @param Page $page
	 */
	public function removePage(Page $page)
	{
		$this->pages->removeElement($page);
	}

	/**
	 * Get pages
	 *
	 * @return Collection
	 */
	public function getPages()
	{
		return $this->pages;
	}

	/**
	 * Tag name
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->name;
	}

}
