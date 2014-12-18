<?php

namespace KRSolutions\Bundle\KRCMSBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use KRSolutions\Bundle\KRCMSBundle\Entity\PageType;
use KRSolutions\Bundle\KRCMSBundle\Entity\Site;


/**
 * PageTypeRepository
 */
class PageTypeRepository extends EntityRepository
{

	/**
	 * Get all PageType entities
	 *
	 * @return array
	 */
	public function getAllPageTypes()
	{
		$qb = $this->createQueryBuilder('pageTypes');

		return $qb->getQuery()->getResult();
	}

	/**
	 * Get all possible child PageType entities by a Site entity
	 *
	 * @param Site $site
	 *
	 * @return array
	 */
	public function getAllPossibleChildPageTypesBySite(Site $site)
	{
		$qb = $this->createQueryBuilder('pageTypes');

		$qb->innerJoin('pageTypes.pageTypeParents', 'pageTypeParents');
		$qb->innerJoin('pageTypeParents.pages', 'pages', Join::WITH, 'pages.site = :site');
		$qb->setParameter('site', $site);

		return $qb->getQuery()->getResult();
	}

	/**
	 * Get all possible parent PageType entities by a Site entity
	 *
	 * @param Site $site
	 *
	 * @return array
	 */
	public function getAllPossibleParentPageTypesBySite(Site $site)
	{
		$qb = $this->createQueryBuilder('pageTypes');

		$qb->where('pageTypes.isChild <> true');

		return $qb->getQuery()->getResult();
	}

	/**
	 * Get PageTypes entity by id
	 *
	 * @param string $pageTypeId
	 *
	 * @return PageType
	 */
	public function getPageTypeById($pageTypeId)
	{
		$qb = $this->createQueryBuilder('pageTypes');

		$qb->where('pageTypes.id = :pageTypeId');
		$qb->setParameter('pageTypeId', $pageTypeId);

		return $qb->getQuery()->getOneOrNullResult();
	}

}
