<?php

namespace KRSolutions\Bundle\KRCMSBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use KRSolutions\Bundle\KRCMSBundle\Entity\PageType;

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
     * Get all possible parent PageType entities
     *
     * @param PageType|null $parentPageType
     *
     * @return array
     */
    public function getPageTypesByParentPageType(PageType $parentPageType = null)
    {
        $qb = $this->createQueryBuilder('pageTypes');

        if (null === $parentPageType) {
            $qb->where('pageTypes.isChild = false');
        } else {
            $qb->innerJoin('pageTypes.pageTypeParents', 'pageTypeParents', Join::WITH, 'pageTypeParents = :parentPageType');
            $qb->setParameter('parentPageType', $parentPageType);
        }

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
