<?php

namespace KRSolutions\Bundle\KRCMSBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use KRSolutions\Bundle\KRCMSBundle\Model\AbstractSiteManager;

/**
 * Site manager
 */
class SiteManager extends AbstractSiteManager
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
    public function getActiveSiteByPermalink($permalink)
    {
        $qb = $this->repository->createQueryBuilder('sites');

        $qb->where('sites.permalink = :permalink');
        $qb->setParameter('permalink', $permalink);

        $qb->andWhere('sites.isActive = true');

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getAllActiveSites()
    {
        $qb = $this->repository->createQueryBuilder('sites');

        $qb->where('sites.isActive = true');

        return $qb->getQuery()->getResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getSiteByPermalink($permalink)
    {
        $qb = $this->repository->createQueryBuilder('sites');

        $qb->where('sites.permalink = :permalink');
        $qb->setParameter('permalink', $permalink);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getSiteById($siteId)
    {
        $qb = $this->repository->createQueryBuilder('sites');

        $qb->where('sites.id = :siteId');
        $qb->setParameter('siteId', $siteId);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getAllSites()
    {
        $qb = $this->repository->createQueryBuilder('sites');

        return $qb->getQuery()->getResult();
    }
}
