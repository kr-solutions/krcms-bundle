<?php

namespace KRSolutions\Bundle\KRCMSBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use KRSolutions\Bundle\KRCMSBundle\Model\AbstractLanguageManager;

/**
 * Language manager
 */
class LanguageManager extends AbstractLanguageManager
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
    public function getAllLanguages()
    {
        $qb = $this->getLanguagesQB();

        return $qb->getQuery()->getResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getLanguageById($languageId)
    {
        $qb = $this->repository->createQueryBuilder('languages');

        $qb->where('languages.id = :languageId');
        $qb->setParameter('languageId', intval($languageId));

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getLanguagesQB()
    {
        $qb = $this->repository->createQueryBuilder('languages');

        return $qb;
    }
}
