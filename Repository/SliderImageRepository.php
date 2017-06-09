<?php

namespace KRSolutions\Bundle\KRCMSBundle\Repository;

use Doctrine\ORM\EntityRepository;
use KRSolutions\Bundle\KRCMSBundle\Entity\Slider;

/**
 * SliderImageRepository
 */
class SliderImageRepository extends EntityRepository
{

    /**
     * Get slider images by slider
     *
     * @param Slider $slider
     *
     * @return array
     */
    public function getSliderImagesBySlider(Slider $slider)
    {
        $qb = $this->createQueryBuilder('slider_images');

        $qb->where('slider_images.slider = :slider');
        $qb->setParameter('slider', $slider);

        return $qb->getQuery()->getResult();
    }
}
