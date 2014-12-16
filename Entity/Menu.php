<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


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
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $pages;

	/**
	 * @var \KRSolutions\Bundle\KRCMSBundle\Entity\Site
	 */
	private $site;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->pages = new \Doctrine\Common\Collections\ArrayCollection();
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
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\Page $page
	 *
	 * @return Menu
	 */
	public function addPage(\KRSolutions\Bundle\KRCMSBundle\Entity\Page $page)
	{
		$this->pages[] = $page;

		return $this;
	}

	/**
	 * Remove page
	 *
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\Page $page
	 */
	public function removePage(\KRSolutions\Bundle\KRCMSBundle\Entity\Page $page)
	{
		$this->pages->removeElement($page);
	}

	/**
	 * Get pages
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getPages()
	{
		return $this->pages;
	}

	/**
	 * Set site
	 *
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\Site $site
	 *
	 * @return Menu
	 */
	public function setSite(\KRSolutions\Bundle\KRCMSBundle\Entity\Site $site = null)
	{
		$this->site = $site;

		return $this;
	}

	/**
	 * Get site
	 *
	 * @return \KRSolutions\Bundle\KRCMSBundle\Entity\Site
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
