<?php

namespace KRSolutions\Bundle\KRCMSBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use KRSolutions\Bundle\KRCMSBundle\Entity\Menu;
use KRSolutions\Bundle\KRCMSBundle\Entity\Page;
use KRSolutions\Bundle\KRCMSBundle\Entity\Site;


/**
 * PageRepository
 */
class PageRepository extends EntityRepository
{

	/**
	 * Get a page by it's site and permalink
	 *
	 * @param Site   $site      Site entity
	 * @param string $permalink Page permalink
	 *
	 * @return Page|null
	 */
	public function getActivePageFromSiteAndPermalink(Site $site, $permalink)
	{
		$qb = $this->createQueryBuilder('pages');
		$qb->addSelect('parent');
		$qb->addSelect('pageTypes');
		$qb->addSelect('parentPageTypes');
		$qb->addSelect('files');

		$qb->leftJoin('pages.parent', 'parent');
		$qb->leftJoin('parent.pageType', 'parentPageTypes');
		$qb->leftJoin('pages.pageType', 'pageTypes');
		$qb->leftJoin('pages.files', 'files');

		$qb->where('pages.site = :site');
		$qb->setParameter('site', $site);

		if (null !== $permalink) {
			$qb->andWhere('pages.permalink = :permalink');
			$qb->setParameter('permalink', $permalink);
		} else {
			$qb->andWhere('pages.permalink IS NULL');
		}

		// Check if the page is active
		$qb->andWhere('pages.publishAt < CURRENT_TIMESTAMP() OR pages.publishAt IS NULL');
		$qb->andWhere('pages.publishTill > CURRENT_TIMESTAMP() OR pages.publishTill IS NULL');

		$qb->orderBy('pages.orderId', 'asc');

		return $qb->getQuery()->getOneOrNullResult();
	}

	/**
	 * Get pages by the site and menu
	 *
	 * @param Site $site Site entity
	 * @param Menu $menu Menu entity
	 *
	 * @return array
	 */
	public function getActivePagesFromSiteAndMenu(Site $site, Menu $menu)
	{
		$qb = $this->createQueryBuilder('pages');

		$qb->where('pages.site = :site');
		$qb->setParameter('site', $site);

		if (null !== $menu) {
			$qb->andWhere('pages.menu = :menu');
			$qb->setParameter('menu', $menu);
		} else {
			$qb->andWhere('pages.menu IS NULL');
		}

		// Check if the page is active
		$qb->andWhere('pages.publishAt < CURRENT_TIMESTAMP() OR pages.publishAt IS NULL');
		$qb->andWhere('pages.publishTill > CURRENT_TIMESTAMP() OR pages.publishTill IS NULL');

		$qb->orderBy('pages.orderId', 'asc');

		return $qb->getQuery()->getResult();
	}

	/**
	 * Get pages by the site and menu
	 *
	 * @param Site   $site     Site entity
	 * @param string $menuName Menu name
	 *
	 * @return array
	 */
	public function getActivePagesFromSiteAndMenuName(Site $site, $menuName = null)
	{
		$qb = $this->createQueryBuilder('pages');

		if (null !== $menuName) {
			$qb->innerJoin('pages.menu', 'menus', Join::WITH, 'menus.site = :site AND menus.name = :menuName');
			$qb->setParameter('site', $site);
			$qb->setParameter('menuName', $menuName);
		} else {
			$qb->andWhere('pages.menu IS NULL');
		}

		$qb->where('pages.site = :site');
		$qb->setParameter('site', $site);

		// Check if the page is active
		$qb->andWhere('pages.publishAt < CURRENT_TIMESTAMP() OR pages.publishAt IS NULL');
		$qb->andWhere('pages.publishTill > CURRENT_TIMESTAMP() OR pages.publishTill IS NULL');

		$qb->orderBy('pages.orderId', 'asc');

		return $qb->getQuery()->getResult();
	}

	/**
	 * Get pages by site
	 *
	 * @param Site $site
	 *
	 * @return array
	 */
	public function getActivePagesFromSite(Site $site)
	{
		$qb = $this->createQueryBuilder('pages');

		$qb->where('pages.site = :site');
		$qb->setParameter('site', $site);

		// Check if the page is active
		$qb->andWhere('pages.publishAt < CURRENT_TIMESTAMP() OR pages.publishAt IS NULL');
		$qb->andWhere('pages.publishTill > CURRENT_TIMESTAMP() OR pages.publishTill IS NULL');

		$qb->orderBy('pages.orderId', 'asc');

		return $qb->getQuery()->getResult();
	}

	/**
	 * Get active pages from parent page
	 *
	 * @param Page $page
	 *
	 * @return array
	 */
	public function getActivePagesFromPage(Page $page)
	{
		$qb = $this->createQueryBuilder('pages');

		if (null !== $page) {
			$qb->andWhere('pages.parent = :page');
			$qb->setParameter('page', $page);
		} else {
			$qb->andWhere('pages.parent IS NULL');
		}

		// Check if the page is active
		$qb->andWhere('pages.publishAt < CURRENT_TIMESTAMP() OR pages.publishAt IS NULL');
		$qb->andWhere('pages.publishTill > CURRENT_TIMESTAMP() OR pages.publishTill IS NULL');

		$qb->orderBy('pages.orderId', 'asc');

		return $qb->getQuery()->getResult();
	}

	/**
	 * Get active pages with a menu title from parent page
	 *
	 * @param Page $page
	 *
	 * @return array
	 */
	public function getActivePagesWithMenuTitleFromPage(Page $page)
	{
		$qb = $this->createQueryBuilder('pages');

		if (null !== $page) {
			$qb->andWhere('pages.parent = :page');
			$qb->setParameter('page', $page);
		} else {
			$qb->andWhere('pages.parent IS NULL');
		}

		$qb->andWhere('pages.menuTitle IS NOT NULL');

		// Check if the page is active
		$qb->andWhere('pages.publishAt < CURRENT_TIMESTAMP() OR pages.publishAt IS NULL');
		$qb->andWhere('pages.publishTill > CURRENT_TIMESTAMP() OR pages.publishTill IS NULL');

		$qb->orderBy('pages.orderId', 'asc');

		return $qb->getQuery()->getResult();
	}

	/**
	 * Get page by id
	 *
	 * @param integer $pageId
	 *
	 * @return null|Page
	 */
	public function getPageById($pageId)
	{
		$qb = $this->createQueryBuilder('pages');

		$qb->where('pages.id = :pageId');
		$qb->setParameter('pageId', intval($pageId));

		return $qb->getQuery()->getOneOrNullResult();
	}

	/**
	 * Get page by permalink
	 *
	 * @param string $permalink
	 *
	 * @return null|Page
	 */
	public function getPageByPermalink($permalink)
	{
		$qb = $this->createQueryBuilder('pages');

		$qb->where('pages.permalink = :permalink');
		$qb->setParameter('permalink', $permalink);

		return $qb->getQuery()->getOneOrNullResult();
	}

	/**
	 * Get all pages
	 *
	 * @return array
	 */
	public function getAllPages()
	{
		$qb = $this->createQueryBuilder('pages');

		$qb->orderBy('pages.orderId', 'asc');

		return $qb->getQuery()->getResult();
	}

	/**
	 * Get all parent pages
	 *
	 * @return array
	 */
	public function getAllParentPages()
	{
		$qb = $this->createQueryBuilder('pages');

		$qb->where('pages.parent IS NULL');
		$qb->orderBy('pages.orderId', 'asc');

		return $qb->getQuery()->getResult();
	}

	/**
	 * Get all loose pages by Site
	 *
	 * @param Site $site
	 *
	 * @return array
	 */
	public function getAllLoosePagesBySite(Site $site)
	{
		$qb = $this->createQueryBuilder('pages');

		$qb->where('pages.parent IS NULL');
		$qb->andWhere('pages.menu IS NULL');

		$qb->andWhere('pages.site = :site');
		$qb->setParameter('site', $site);

		$qb->orderBy('pages.orderId', 'asc');

		return $qb->getQuery()->getResult();
	}

	/**
	 * Get all child pages
	 *
	 * @param Page $parentPage
	 *
	 * @return array
	 */
	public function getAllChildPages(Page $parentPage)
	{
		$qb = $this->createQueryBuilder('pages');

		$qb->where('pages.parent = :parentPage');
		$qb->setParameter('parentPage', $parentPage);

		$qb->orderBy('pages.orderId', 'asc');

		return $qb->getQuery()->getResult();
	}

	/**
	 * getAllChildablePagesQB
	 *
	 * @return QueryBuilder
	 */
	public function getAllChildablePagesQB()
	{
		$qb = $this->createQueryBuilder('pages');

		$qb->innerJoin('pages.pageType', 'pageType', Join::WITH, 'pageType.hasChildren = true');

		return $qb;
	}

	/**
	 * getAllChildablePagesBySite
	 *
	 * @param Site $site
	 *
	 * @return array
	 */
	public function getAllChildablePagesBySite(Site $site)
	{
		$qb = $this->getAllChildablePagesQB();

		$qb->andWhere('pages.site = :site');
		$qb->setParameter('site', $site);

		return $qb->getQuery()->getResult();
	}

	/**
	 * Get all childable pages except for the given page
	 *
	 * @param Page $exceptThisPage
	 *
	 * @return QueryBuilder
	 */
	public function getAllChildablePagesExceptThisPageQB(Page $exceptThisPage = null)
	{
		$qb = $this->getAllChildablePagesQB();

		if (null !== $exceptThisPage && null !== $exceptThisPage->getId()) {
			$qb->where('pages <> :exceptThisPage');
			$qb->setParameter('exceptThisPage', $exceptThisPage);
		}

		if (null !== $exceptThisPage) {
			$qb->andWhere('pages.site = :site');
			$qb->setParameter('site', $exceptThisPage->getSite());
		}

		$qb->innerJoin('pages.pageType', 'parentPageType');
		$qb->innerJoin('parentPageType.pageTypeChildren', 'pageTypeChildren', Join::WITH, 'pageTypeChildren = :pageTypeChild');
		$qb->setParameter('pageTypeChild', $exceptThisPage->getPageType());

		return $qb;
	}

	/**
	 * Get first pages by pageTypeId
	 *
	 * @param string $pageTypeId Id of the PageType
	 * @param int    $nrOfPages  Number of pages to fetch
	 *
	 * @return array
	 */
	public function getFirstPagesByPageTypeId($pageTypeId, $nrOfPages)
	{
		$qb = $this->createQueryBuilder('pages');

		$qb->innerJoin('pages.pageType', 'pageType', Join::WITH, 'pageType.id = :pageTypeId');
		$qb->setParameter('pageTypeId', $pageTypeId);

		$qb->orderBy('pages.orderId', 'asc');
		$qb->setMaxResults($nrOfPages);

		return $qb->getQuery()->getResult();
	}

	/**
	 * Get the next page permalink in the menu
	 *
	 * @param Page $activePage
	 *
	 * @return string|null
	 */
	public function getNextPermalinkInMenu(Page $activePage)
	{
		$qb = $this->createQueryBuilder('pages');
		$qb->select('pages.permalink');

		$qb->where('pages.menu = :menu');
		$qb->setParameter('menu', $activePage->getMenu());

		$qb->andWhere('pages.orderId > :orderId');
		$qb->setParameter('orderId', $activePage->getOrderId());

		$qb->orderBy('pages.orderId', 'asc');
		$qb->setMaxResults(1);

		$result = $qb->getQuery()->getOneOrNullResult();

		if (null === $result) {
			return null;
		}

		return $result['permalink'];
	}

	/**
	 * Get the previous page permalink in the menu
	 *
	 * @param Page $activePage
	 *
	 * @return string|null
	 */
	public function getPreviousPermalinkInMenu(Page $activePage)
	{
		$qb = $this->createQueryBuilder('pages');
		$qb->select('pages.permalink');

		$qb->where('pages.menu = :menu');
		$qb->setParameter('menu', $activePage->getMenu());

		$qb->andWhere('pages.orderId < :orderId');
		$qb->setParameter('orderId', $activePage->getOrderId());

		$qb->orderBy('pages.orderId', 'desc');
		$qb->setMaxResults(1);

		$result = $qb->getQuery()->getOneOrNullResult();

		if (null === $result) {
			return null;
		}

		return $result['permalink'];
	}

	/**
	 * Get last page from a parent page with the parent permalink
	 *
	 * @param string $permalink
	 *
	 * @return Page
	 */
	public function getLastPageFromParentByPermalink($permalink)
	{
		$qb = $this->createQueryBuilder('pages');

		$qb->innerJoin('pages.parent', 'parent', Join::WITH, 'parent.permalink = :permalink');
		$qb->setParameter('permalink', $permalink);

		$qb->orderBy('pages.orderId', 'desc');
		$qb->setMaxResults(1);

		return $qb->getQuery()->getOneOrNullResult();
	}

	/**
	 * Get last page from a parent page with the parent permalink
	 *
	 * @param string $permalink
	 *
	 * @return Page
	 */
	public function getNewestPageFromParentByPermalink($permalink)
	{
		$qb = $this->createQueryBuilder('pages');

		$qb->innerJoin('pages.parent', 'parent', Join::WITH, 'parent.permalink = :permalink');
		$qb->setParameter('permalink', $permalink);

		$qb->orderBy('pages.createdAt', 'desc');
		$qb->setMaxResults(1);

		return $qb->getQuery()->getOneOrNullResult();
	}

	/**
	 * Get last number of pages from a parent page with the parent permalink
	 *
	 * @param string $permalink
	 * @param int    $number
	 *
	 * @return Page
	 */
	public function getLastPagesFromParentByPermalink($permalink, $number)
	{
		$qb = $this->createQueryBuilder('pages');

		$qb->innerJoin('pages.parent', 'parent', Join::WITH, 'parent.permalink = :permalink');
		$qb->setParameter('permalink', $permalink);

		$qb->orderBy('pages.orderId', 'desc');
		$qb->setMaxResults($number);

		return $qb->getQuery()->getResult();
	}

	/**
	 * Get newest number of pages from a parent page with the parent permalink
	 *
	 * @param string $permalink
	 * @param int    $number
	 *
	 * @return Page
	 */
	public function getNewestPagesFromParentByPermalink($permalink, $number)
	{
		$qb = $this->createQueryBuilder('pages');

		$qb->innerJoin('pages.parent', 'parent', Join::WITH, 'parent.permalink = :permalink');
		$qb->setParameter('permalink', $permalink);

		$qb->orderBy('pages.createdAt', 'desc');
		$qb->setMaxResults($number);

		return $qb->getQuery()->getResult();
	}

	/**
	 * Get the next page permalink from the parent page
	 *
	 * @param Page $page
	 *
	 * @return string|null
	 */
	public function getNextPermalinkFromParentPage(Page $page)
	{
		$parentPage = $page->getParent();

		if (!($parentPage instanceof Page)) {
			return null;
		}

		$qb = $this->createQueryBuilder('pages');
		$qb->select('pages.permalink');

		$qb->where('pages.parent = :parentPage');
		$qb->setParameter('parentPage', $parentPage);

		if (null !== $parentPage->getPageType()->getChildrenOrderDirection()) {
			$order = trim(strtolower($parentPage->getPageType()->getChildrenOrderDirection()));

			if ('asc' !== $order && 'desc' !== $order) {
				$order = 'asc';
			}
		} else {
			$order = 'asc';
		}

		switch ($parentPage->getPageType()->getChildrenOrderBy()) {
			case 'createdAt':
				$qb->andWhere('pages.createdAt < :createdAt');
				$qb->setParameter('createdAt', $page->getCreatedAt());

				$qb->orderBy('pages.createdAt', $order);

				break;
			case 'orderId':
			default:
				$qb->andWhere('pages.orderId > :orderId');
				$qb->setParameter('orderId', $page->getOrderId());

				$qb->orderBy('pages.orderId', $order);

				break;
		}

		$qb->setMaxResults(1);

		$result = $qb->getQuery()->getOneOrNullResult();

		if (null === $result) {
			return null;
		}

		return $result['permalink'];
	}

	/**
	 * Get the next page permalink from the parent page
	 *
	 * @param Page $page
	 *
	 * @return string|null
	 */
	public function getPreviousPermalinkFromParentPage(Page $page)
	{
		$parentPage = $page->getParent();

		if (!($parentPage instanceof Page)) {
			return null;
		}

		$qb = $this->createQueryBuilder('pages');
		$qb->select('pages.permalink');

		$qb->where('pages.parent = :parentPage');
		$qb->setParameter('parentPage', $parentPage);

		if (null !== $parentPage->getPageType()->getChildrenOrderDirection()) {
			$order = trim(strtolower($parentPage->getPageType()->getChildrenOrderDirection()));

			if ('asc' !== $order && 'desc' !== $order) {
				$order = 'asc';
			} else if ($order === 'asc') {
				$order = 'desc';
			} else if ($order === 'desc') {
				$order = 'asc';
			}
		} else {
			$order = 'asc';
		}

		switch ($parentPage->getPageType()->getChildrenOrderBy()) {
			case 'createdAt':
				$qb->andWhere('pages.createdAt > :createdAt');
				$qb->setParameter('createdAt', $page->getCreatedAt());

				$qb->orderBy('pages.createdAt', $order);

				break;
			case 'orderId':
			default:
				$qb->andWhere('pages.orderId < :orderId');
				$qb->setParameter('orderId', $page->getOrderId());

				$qb->orderBy('pages.orderId', $order);

				break;
		}

		$qb->setMaxResults(1);

		$result = $qb->getQuery()->getOneOrNullResult();

		if (null === $result) {
			return null;
		}

		return $result['permalink'];
	}

	/**
	 * Get page count by site
	 *
	 * @param Site $site
	 *
	 * @return int
	 */
	public function getPageCountBySite(Site $site)
	{
		$qb = $this->createQueryBuilder('pages');

		$qb->select('count(pages.id)');

		$qb->where('pages.site = :site');
		$qb->setParameter('site', $site);

		return intval($qb->getQuery()->getSingleScalarResult());
	}

}
