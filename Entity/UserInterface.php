<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

/**
 * User interface
 */
interface UserInterface
{

    /**
     * Get the username for display in the KRCMS
     *
     * @return string
     */
    public function getKRCMSUsername();
}
