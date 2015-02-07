<?php

namespace KRSolutions\Bundle\KRCMSBundle\Model;

use Doctrine\ORM\QueryBuilder;
use KRSolutions\Bundle\KRCMSBundle\Entity\MenuInterface;
use KRSolutions\Bundle\KRCMSBundle\Entity\PageInterface;
use KRSolutions\Bundle\KRCMSBundle\Entity\SiteInterface;


/**
 * Page manager interface
 */
interface PageManagerInterface
{

	/**
	 * Create a new page
	 *
	 * @return \KRSolutions\Bundle\KRCMSBundle\Entity\PageInterface
	 */
	public function createPage();

	/**
	 * Returns the page's fully qualified class name.
	 *
	 * @return string
	 */
	public function getClass();

	/**
	 * Get a page by it's site and permalink
	 *
	 * @param SiteInterface $site      Site entity
	 * @param string        $permalink Page permalink
	 *
	 * @return PageInterface|null
	 */
	public function getActivePageFromSiteAndPermalink(SiteInterface $site, $permalink);

	/**
	 * Get pages by the site and menu
	 *
	 * @param SiteInterface $site Site entity
	 * @param MenuInterface $menu Menu entity
	 *
	 * @return array
	 */
	public function getActivePagesFromSiteAndMenu(SiteInterface $site, MenuInterface $menu);

	/**
	 * Get pages by the site and menu
	 *
	 * @param SiteInterface $site     Site entity
	 * @param string        $menuName Menu name
	 *
	 * @return array
	 */
	public function getActivePagesFromSiteAndMenuName(SiteInterface $site, $menuName = null);

	/**
	 * Get pages by site (query builder)
	 *
	 * @param SiteInterface $site
	 *
	 * @return array
	 */
	public function getActivePagesFromSiteQB(SiteInterface $site);

	/**
	 * Get active pages from parent page
	 *
	 * @param PageInterface $page
	 *
	 * @return array
	 */
	public function getActivePagesFromPage(PageInterface $page);

	/**
	 * Get active pages with a menu title from parent page
	 *
	 * @param PageInterface $page
	 *
	 * @return array
	 */
	public function getActivePagesWithMenuTitleFromPage(PageInterface $page);

	/**
	 * Get page by id
	 *
	 * @param integer $pageId
	 *
	 * @return null|PageInterface
	 */
	public function getPageById($pageId);

	/**
	 * Get page by permalink
	 *
	 * @param string $permalink
	 *
	 * @return null|PageInterface
	 */
	public function getPageByPermalink($permalink);

	/**
	 * Get all pages
	 *
	 * @return array
	 */
	public function getAllPages();

	/**
	 * Get all parent pages
	 *
	 * @return array
	 */
	public function getAllParentPages();

	/**
	 * Get all loose pages by Site
	 *
	 * @param SiteInterface $site
	 *
	 * @return array
	 */
	public function getAllLoosePagesBySite(SiteInterface $site);

	/**
	 * Get all child pages
	 *
	 * @param PageInterface $parentPage
	 *
	 * @return array
	 */
	public function getAllChildPages(PageInterface $parentPage);

	/**
	 * getAllChildablePagesQB
	 *
	 * @return QueryBuilder
	 */
	public function getAllChildablePagesQB();

	/**
	 * getAllChildablePagesBySite
	 *
	 * @param SiteInterface $site
	 *
	 * @return array
	 */
	public function getAllChildablePagesBySite(SiteInterface $site);

	/**
	 * Get all childable pages except for the given page
	 *
	 * @param PageInterface $exceptThisPage
	 *
	 * @return QueryBuilder
	 */
	public function getAllChildablePagesExceptThisPageQB(PageInterface $exceptThisPage = null);

	/**
	 * Get first pages by pageTypeId
	 *
	 * @param string $pageTypeId Id of the PageType
	 * @param int    $nrOfPages  Number of pages to fetch
	 *
	 * @return array
	 */
	public function getFirstPagesByPageTypeId($pageTypeId, $nrOfPages);

	/**
	 * Get the next page permalink in the menu
	 *
	 * @param PageInterface $activePage
	 *
	 * @return string|null
	 */
	public function getNextPermalinkInMenu(PageInterface $activePage);

	/**
	 * Get the previous page permalink in the menu
	 *
	 * @param PageInterface $activePage
	 *
	 * @return string|null
	 */
	public function getPreviousPermalinkInMenu(PageInterface $activePage);

	/**
	 * Get last page from a parent page with the parent permalink
	 *
	 * @param string $permalink
	 *
	 * @return PageInterface
	 */
	public function getLastPageFromParentByPermalink($permalink);

	/**
	 * Get last page from a parent page with the parent permalink
	 *
	 * @param string $permalink
	 *
	 * @return PageInterface
	 */
	public function getNewestPageFromParentByPermalink($permalink);

	/**
	 * Get last number of pages from a parent page with the parent permalink
	 *
	 * @param string $permalink
	 * @param int    $number
	 *
	 * @return PageInterface
	 */
	public function getLastPagesFromParentByPermalink($permalink, $number);

	/**
	 * Get newest number of pages from a parent page with the parent permalink
	 *
	 * @param string $permalink
	 * @param int    $number
	 *
	 * @return PageInterface
	 */
	public function getNewestPagesFromParentByPermalink($permalink, $number);

	/**
	 * Get the next page permalink from the parent page
	 *
	 * @param PageInterface $page
	 *
	 * @return string|null
	 */
	public function getNextPermalinkFromParentPage(PageInterface $page);

	/**
	 * Get the next page permalink from the parent page
	 *
	 * @param PageInterface $page
	 *
	 * @return string|null
	 */
	public function getPreviousPermalinkFromParentPage(PageInterface $page);

	/**
	 * Get page count by site
	 *
	 * @param SiteInterface $site
	 *
	 * @return int
	 */
	public function getPageCountBySite(SiteInterface $site);
}
