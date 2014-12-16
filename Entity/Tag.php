<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


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
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $pages;

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
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\Page $page
	 *
	 * @return Tag
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

}
