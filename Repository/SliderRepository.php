<?php

namespace KRSolutions\Bundle\KRCMSBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * SliderRepository
 */
class SliderRepository extends EntityRepository
{

    /**
     * Get the default slider
     *
     * @return array
     */
    public function getDefaultSlider()
    {
        $qb = $this->createQueryBuilder('sliders');

        $qb->where('sliders.isDefault = true');

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * Get slider by id
     *
     * @param integer $sliderId
     *
     * @return null|Slider
     */
    public function getSliderById($sliderId)
    {
        $qb = $this->createQueryBuilder('sliders');

        $qb->where('sliders.id = :sliderId');
        $qb->setParameter('sliderId', intval($sliderId));

        return $qb->getQuery()->getOneOrNullResult();
    }

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
