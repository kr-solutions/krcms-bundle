<?php

namespace KRSolutions\Bundle\KRCMSBundle\Model;

/**
 * Abstract site manager
 */
abstract class SiteManager implements SiteManagerInterface
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
    public function createSite()
    {
        $class = $this->getClass();
        $site = new $class;

        return $site;
    }
}
