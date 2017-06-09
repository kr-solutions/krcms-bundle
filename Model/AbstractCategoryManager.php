<?php

namespace KRSolutions\Bundle\KRCMSBundle\Model;

/**
 * Abstract category manager
 */
abstract class AbstractCategoryManager implements CategoryManagerInterface
{

    /**
     * Constructor
     */
    public function __construct()
    {

    }

    /**
     * {@inheritDoc}
     */
    public function createCategory()
    {
        $class = $this->getClass();
        $category = new $class;

        return $category;
    }
}
