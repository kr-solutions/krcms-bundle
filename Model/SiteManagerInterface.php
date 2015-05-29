<?php

namespace KRSolutions\Bundle\KRCMSBundle\Model;

/**
 * Site manager interface
 */
interface SiteManagerInterface
{

    /**
     * Create a new site
     *
     * @return \KRSolutions\Bundle\KRCMSBundle\Entity\SiteInterface
     */
    public function createSite();

    /**
     * Get an active site by it's permalink
     *
     * @param string $permalink
     *
     * @return KRSolutions\Bundle\KRCMSBundle\Entity\SiteInterface|null
     */
    public function getActiveSiteByPermalink($permalink);

    /**
     * Get all active Sites
     *
     * @return array
     */
    public function getAllActiveSites();

    /**
     * Get a site by it's permalink
     *
     * @param string $permalink
     *
     * @return KRSolutions\Bundle\KRCMSBundle\Entity\SiteInterface|null
     */
    public function getSiteByPermalink($permalink);

    /**
     * Get a site by it's id
     *
     * @param integer $siteId
     *
     * @return KRSolutions\Bundle\KRCMSBundle\Entity\SiteInterface|null
     */
    public function getSiteById($siteId);

    /**
     * Get all sites
     *
     * @return array
     */
    public function getAllSites();

    /**
     * Returns the site's fully qualified class name.
     *
     * @return string
     */
    public function getClass();
}
