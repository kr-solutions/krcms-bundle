<?php

namespace KRSolutions\Bundle\KRCMSBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * SliderRepository
 */
class SliderRepository extends EntityRepository
{

    /**
     * Get Sliders QB
     *
     * @return QueryBuilder
     */
    public function getSlidersQB()
    {
        $qb = $this->createQueryBuilder('sliders');

        return $qb;
    }
}
