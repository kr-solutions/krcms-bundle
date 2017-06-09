<?php

namespace KRSolutions\Bundle\KRCMSBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use KRSolutions\Bundle\KRCMSBundle\Model\AbstractSliderManager;

/**
 * Slider manager
 */
class SliderManager extends AbstractSliderManager
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
    public function getAllSliders()
    {
        $qb = $this->getSlidersQB();

        return $qb->getQuery()->getResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getSliderById($sliderId)
    {
        $qb = $this->repository->createQueryBuilder('sliders');

        $qb->where('sliders.id = :sliderId');
        $qb->setParameter('sliderId', intval($sliderId));

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getSliderByName($sliderName)
    {
        $qb = $this->repository->createQueryBuilder('sliders');

        $qb->where('sliders.name = :sliderName');
        $qb->setParameter('sliderName', $sliderName);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getSlidersQB()
    {
        $qb = $this->repository->createQueryBuilder('sliders');

        return $qb;
    }
}
