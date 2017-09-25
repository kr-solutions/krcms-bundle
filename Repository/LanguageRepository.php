<?php

namespace KRSolutions\Bundle\KRCMSBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use KRSolutions\Bundle\KRCMSBundle\Entity\Language;

/**
 * LanguageRepository
 */
class LanguageRepository extends EntityRepository
{

    /**
     * Get all Languages
     *
     * @return array
     */
    public function getAllLanguages()
    {
        $qb = $this->createQueryBuilder('languages');

        return $qb->getQuery()->getResult();
    }

    /**
     * Get Languages Entity by id
     *
     * @param integer $languageId
     *
     * @return Language
     */
    public function getLanguageById($languageId)
    {
        $qb = $this->createQueryBuilder('languages');

        $qb->where('languages.id = :languageId');
        $qb->setParameter('languageId', intval($languageId));

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * Get Languages QB
     *
     * @return QueryBuilder
     */
    public function getLanguagesQB()
    {
        $qb = $this->createQueryBuilder('languages');

        return $qb;
    }
}
