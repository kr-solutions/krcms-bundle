<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


/**
 * Category
 */
class Category
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
	 * @var string
	 */
	private $description;

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
	 * @return Category
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
	 * Set description
	 *
	 * @param string $description
	 *
	 * @return Category
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
	 * Add page
	 *
	 * @param Page $page
	 *
	 * @return Category
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
	 * Category name
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->name;
	}

}
