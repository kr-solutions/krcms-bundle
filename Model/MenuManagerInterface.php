<?php

namespace KRSolutions\Bundle\KRCMSBundle\Model;

use Doctrine\ORM\QueryBuilder;
use KRSolutions\Bundle\KRCMSBundle\Entity\MenuInterface;
use KRSolutions\Bundle\KRCMSBundle\Entity\SiteInterface;


/**
 * Menu manager interface
 */
interface MenuManagerInterface
{

	/**
	 * Create a new menu
	 *
	 * @return MenuInterface
	 */
	public function createMenu();

	/**
	 * Returns the menu's fully qualified class name.
	 *
	 * @return string
	 */
	public function getClass();

	/**
	 * Get all menu's
	 *
	 * @return array
	 */
	public function findAll();

	/**
	 * Get all Menus by Site
	 *
	 * @param SiteInterface $site
	 *
	 * @return array
	 */
	public function getAllMenusBySite(SiteInterface $site);

	/**
	 * Get Menus Entity by id
	 *
	 * @param integer $menuId
	 *
	 * @return MenuInterface
	 */
	public function getMenuById($menuId);

	/**
	 * Get Menus Entity by name
	 *
	 * @param string $menuName
	 *
	 * @return MenuInterface
	 */
	public function getMenuByName($menuName);

	/**
	 * Get Menus Entity by Site and name
	 *
	 * @param SiteInterface $site     Site entity
	 * @param string        $menuName Menu name
	 *
	 * @return MenuInterface
	 */
	public function getMenuBySiteAndName(SiteInterface $site, $menuName);

	/**
	 * Get Menus by Site
	 *
	 * @param SiteInterface $site
	 *
	 * @return QueryBuilder
	 */
	public function getMenusBySiteQB(SiteInterface $site);
}
