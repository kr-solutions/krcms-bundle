<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

/**
 * PageMeta interface
 */
interface PageMetaInterface
{

    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set metaKey
     *
     * @param string $metaKey
     *
     * @return PageMetaInterface
     */
    public function setMetaKey($metaKey);

    /**
     * Get metaKey
     *
     * @return string
     */
    public function getMetaKey();

    /**
     * Set metaValue
     *
     * @param string $metaValue
     *
     * @return PageMetaInterface
     */
    public function setMetaValue($metaValue);

    /**
     * Get metaValue
     *
     * @return string
     */
    public function getMetaValue();

    /**
     * Set page
     *
     * @param PageInterface $page
     *
     * @return PageMetaInterface
     */
    public function setPage(PageInterface $page = null);

    /**
     * Get page
     *
     * @return PageInterface
     */
    public function getPage();

    /**
     * PageMeta title
     *
     * @return string
     */
    public function __toString();
}
