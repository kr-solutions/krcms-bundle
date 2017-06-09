<?php

namespace KRSolutions\Bundle\KRCMSBundle\Model;

use Doctrine\ORM\QueryBuilder;
use KRSolutions\Bundle\KRCMSBundle\Entity\MenuInterface;

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
     * Get all Menus
     *
     * @return array
     */
    public function getAllMenus();

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
     * Get Menus
     *
     * @return QueryBuilder
     */
    public function getMenusQB();
}
