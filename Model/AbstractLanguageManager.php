<?php

namespace KRSolutions\Bundle\KRCMSBundle\Model;

/**
 * Abstract language manager
 */
abstract class AbstractLanguageManager implements LanguageManagerInterface
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
    public function createLanguage()
    {
        $class = $this->getClass();
        $menu = new $class;

        return $menu;
    }
}
