<?php

namespace KRSolutions\Bundle\KRCMSBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use KRSolutions\Bundle\KRCMSBundle\Entity\Menu;
use KRSolutions\Bundle\KRCMSBundle\Entity\Site;

/**
 * MenuRepository
 */
class MenuRepository extends EntityRepository
{

    /**
     * Get all Menus by Site
     *
     * @param Site $site
     *
     * @return array
     */
    public function getAllMenusBySite(Site $site)
    {
        $qb = $this->createQueryBuilder('menus');

        $qb->where('menus.site = :site');
        $qb->setParameter('site', $site);

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
     * Get Menus Entity by Site and name
     *
     * @param Site   $site     Site entity
     * @param string $menuName Menu name
     *
     * @return Menu
     */
    public function getMenuBySiteAndName(Site $site, $menuName)
    {
        $qb = $this->createQueryBuilder('menus');

        $qb->where('menus.site = :site');
        $qb->setParameter('site', $site);

        $qb->andWhere('menus.name = :menuName');
        $qb->setParameter('menuName', $menuName);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * Get Menus by Site
     *
     * @param Site $site
     *
     * @return QueryBuilder
     */
    public function getMenusBySiteQB(Site $site)
    {
        $qb = $this->createQueryBuilder('menus');

        $qb->where('menus.site = :site');
        $qb->setParameter('site', $site);

        return $qb;
    }
}
