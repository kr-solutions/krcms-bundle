<?php

namespace KRSolutions\Bundle\KRCMSBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use KRSolutions\Bundle\KRCMSBundle\Entity\Menu;

/**
 * MenuRepository
 */
class MenuRepository extends EntityRepository
{

    /**
     * Get all Menus
     *
     * @return array
     */
    public function getAllMenus()
    {
        $qb = $this->createQueryBuilder('menus');

        return $qb->getQuery()->getResult();
    }

    /**
     * Get Menus Entity by id
     *
     * @param integer $menuId
     *
     * @return Menu
     */
    public function getMenuById($menuId)
    {
        $qb = $this->createQueryBuilder('menus');

        $qb->where('menus.id = :menuId');
        $qb->setParameter('menuId', intval($menuId));

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * Get Menus Entity by name
     *
     * @param string $menuName
     *
     * @return Menu
     */
    public function getMenuByName($menuName)
    {
        $qb = $this->createQueryBuilder('menus');

        $qb->where('menus.name = :menuName');
        $qb->setParameter('menuName', $menuName);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * Get Menus QB
     *
     * @return QueryBuilder
     */
    public function getMenusQB()
    {
        $qb = $this->createQueryBuilder('menus');

        return $qb;
    }
}
