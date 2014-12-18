<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


/**
 * Menu
 */
class Menu
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
	 * @var Site
	 */
	private $site;

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
	 * @return Menu
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
	 * @return Menu
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
	 * @return Menu
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
	 * Set site
	 *
	 * @param Site $site
	 *
	 * @return Menu
	 */
	public function setSite(Site $site = null)
	{
		$this->site = $site;

		return $this;
	}

	/**
	 * Get site
	 *
	 * @return Site
	 */
	public function getSite()
	{
		return $this->site;
	}

	/**
	 * Menu name
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->name;
	}

}
