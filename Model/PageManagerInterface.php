<?php

namespace KRSolutions\Bundle\KRCMSBundle\Model;

use Doctrine\ORM\QueryBuilder;
use KRSolutions\Bundle\KRCMSBundle\Entity\MenuInterface;
use KRSolutions\Bundle\KRCMSBundle\Entity\PageInterface;
use KRSolutions\Bundle\KRCMSBundle\Entity\PageTypeInterface;

/**
 * Page manager interface
 */
interface PageManagerInterface
{

    /**
     * Create a new page
     *
     * @return PageInterface
     */
    public function createPage();

    /**
     * Returns the page's fully qualified class name.
     *
     * @return string
     */
    public function getClass();

    /**
     * Get a page by it's permalink
     *
     * @param string $permalink Page permalink
     *
     * @return PageInterface|null
     */
    public function getActivePageFromPermalink($permalink);

    /**
     * Get pages by menu
     *
     * @param MenuInterface $menu Menu entity
     *
     * @return array
     */
    public function getActivePagesFromMenu(MenuInterface $menu);

    /**
     * Get pages by menu name
     *
     * @param string        $menuName Menu name
     *
     * @return array
     */
    public function getActivePagesFromMenuName($menuName = null);

    /**
     * Get active pages (query builder)
     *
     * @return array
     */
    public function getActivePagesQB();

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
     * Get all loose pages
     *
     * @return array
     */
    public function getAllLoosePages();

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
     * getAllChildablePages
     *
     * @return array
     */
    public function getAllChildablePages();

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
     * Get page count
     *
     * @return int
     */
    public function getPageCount();

    /**
     * Get page count by page type
     *
     * @param PageTypeInterface $pageType
     *
     * @return int
     */
    public function getPageCountByPageType(PageTypeInterface $pageType);
}
