<?php

namespace KRSolutions\Bundle\KRCMSBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use KRSolutions\Bundle\KRCMSBundle\Model\AbstractMenuManager;

/**
 * Menu manager
 */
class MenuManager extends AbstractMenuManager
{

    protected $objectManager;
    protected $class;
    protected $repository;

    /**
     * Constructor
     *
     * @param ObjectManager $om
     * @param string        $class
     */
    public function __construct(ObjectManager $om, $class)
    {
        parent::__construct();

        $this->objectManager = $om;
        $this->repository = $om->getRepository($class);

        $metadata = $om->getClassMetadata($class);
        $this->class = $metadata->getName();
    }

    /**
     * {@inheritDoc}
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * {@inheritDoc}
     */
    public function findAll()
    {
        return $this->repository->findAll();
    }

    /**
     * {@inheritDoc}
     */
    public function getAllMenus()
    {
        $qb = $this->getMenusQB();

        return $qb->getQuery()->getResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getMenuById($menuId)
    {
        $qb = $this->repository->createQueryBuilder('menus');

        $qb->where('menus.id = :menuId');
        $qb->setParameter('menuId', intval($menuId));

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getMenuByName($menuName)
    {
        $qb = $this->repository->createQueryBuilder('menus');

        $qb->where('menus.name = :menuName');
        $qb->setParameter('menuName', $menuName);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getMenusQB()
    {
        $qb = $this->repository->createQueryBuilder('menus');

        return $qb;
    }
}
