<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

/**
 * Tag interface
 */
interface TagInterface
{

    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return TagInterface
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Tag name
     *
     * @return string
     */
    public function __toString();
}
