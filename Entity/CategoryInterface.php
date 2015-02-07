<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;


/**
 * Category
 */
interface CategoryInterface
{

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId();

	/**
	 * Set name
	 *
	 * @param string $name
	 *
	 * @return CategoryInterface
	 */
	public function setName($name);

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName();

	/**
	 * Set description
	 *
	 * @param string $description
	 *
	 * @return CategoryInterface
	 */
	public function setDescription($description);

	/**
	 * Get description
	 *
	 * @return string
	 */
	public function getDescription();

	/**
	 * Category name
	 *
	 * @return string
	 */
	public function __toString();
}
