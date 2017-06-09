<?php

namespace KRSolutions\Bundle\KRCMSBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use KRSolutions\Bundle\KRCMSBundle\Model\AbstractCategoryManager;

/**
 * Category manager
 */
class CategoryManager extends AbstractCategoryManager
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
    public function getAllCategories()
    {
        $qb = $this->getCategoriesQB();

        return $qb->getQuery()->getResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getCategoryById($categoryId)
    {
        $qb = $this->repository->createQueryBuilder('categories');

        $qb->where('categories.id = :categoryId');
        $qb->setParameter('categoryId', intval($categoryId));

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getCategoryByName($categoryName)
    {
        $qb = $this->repository->createQueryBuilder('categories');

        $qb->where('categories.name = :categoryName');
        $qb->setParameter('categoryName', $categoryName);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getCategoriesQB()
    {
        $qb = $this->repository->createQueryBuilder('categories');

        return $qb;
    }
}
