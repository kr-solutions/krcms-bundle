<?php

namespace KRSolutions\Bundle\KRCMSBundle\Model;

/**
 * Abstract menu manager
 */
abstract class MenuManager implements MenuManagerInterface
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
    public function createMenu()
    {
        $class = $this->getClass();
        $menu = new $class;

        return $menu;
    }
}
