<?php

namespace KRSolutions\Bundle\KRCMSBundle\Repository;

use Doctrine\ORM\EntityRepository;
use KRSolutions\Bundle\KRCMSBundle\Entity\Site;


/**
 * SiteRepository
 */
class SiteRepository extends EntityRepository
{

	/**
	 * Get an active site by it's permalink
	 *
	 * @param string $permalink
	 *
	 * @return Site|null
	 */
	public function getActiveSiteByPermalink($permalink)
	{
		$qb = $this->createQueryBuilder('sites');

		$qb->where('sites.permalink = :permalink');
		$qb->setParameter('permalink', $permalink);

		$qb->andWhere('sites.isActive = true');

		return $qb->getQuery()->getOneOrNullResult();
	}

	/**
	 * Get all active Sites
	 *
	 * @return array
	 */
	public function getAllActiveSites()
	{
		$qb = $this->createQueryBuilder('sites');

		$qb->where('sites.isActive = true');

		return $qb->getQuery()->getResult();
	}

	/**
	 * Get a site by it's permalink
	 *
	 * @param string $permalink
	 *
	 * @return Site|null
	 */
	public function getSiteByPermalink($permalink)
	{
		$qb = $this->createQueryBuilder('sites');

		$qb->where('sites.permalink = :permalink');
		$qb->setParameter('permalink', $permalink);

		return $qb->getQuery()->getOneOrNullResult();
	}

	/**
	 * Get a site by it's id
	 *
	 * @param integer $siteId
	 *
	 * @return Site|null
	 */
	public function getSiteById($siteId)
	{
		$qb = $this->createQueryBuilder('sites');

		$qb->where('sites.id = :siteId');
		$qb->setParameter('siteId', $siteId);

		return $qb->getQuery()->getOneOrNullResult();
	}

	/**
	 * Get all sites
	 *
	 * @return array
	 */
	public function getAllSites()
	{
		$qb = $this->createQueryBuilder('sites');

		return $qb->getQuery()->getResult();
	}

}
