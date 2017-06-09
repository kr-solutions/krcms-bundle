<?php

namespace KRSolutions\Bundle\KRCMSBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Query\Expr\Join;
use KRSolutions\Bundle\KRCMSBundle\Entity\MenuInterface;
use KRSolutions\Bundle\KRCMSBundle\Entity\PageInterface;
use KRSolutions\Bundle\KRCMSBundle\Entity\PageTypeInterface;
use KRSolutions\Bundle\KRCMSBundle\Model\AbstractPageManager;

/**
 * Page manager
 */
class PageManager extends AbstractPageManager
{

    protected $objectManager;
    protected $class;
    protected $repository;

    /**
     * Constructor
     *
     * @param ObjectManager $om
     * @param string        $class
     */
    public function __construct(ObjectManager $om, $class)
    {
        parent::__construct();

        $this->objectManager = $om;
        $this->repository = $om->getRepository($class);

        $metadata = $om->getClassMetadata($class);
        $this->class = $metadata->getName();
    }

    /**
     * {@inheritDoc}
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * {@inheritDoc}
     */
    public function getActivePageFromPermalink($permalink)
    {
        $qb = $this->repository->createQueryBuilder('pages');
        $qb->addSelect('parent');
        $qb->addSelect('pageTypes');
        $qb->addSelect('parentPageTypes');
        $qb->addSelect('files');

        $qb->leftJoin('pages.parent', 'parent');
        $qb->leftJoin('parent.pageType', 'parentPageTypes');
        $qb->leftJoin('pages.pageType', 'pageTypes');
        $qb->leftJoin('pages.files', 'files');

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
     * {@inheritDoc}
     */
    public function getActivePagesFromMenu(MenuInterface $menu)
    {
        $qb = $this->repository->createQueryBuilder('pages');

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
     * {@inheritDoc}
     */
    public function getActivePagesFromMenuName($menuName = null)
    {
        $qb = $this->repository->createQueryBuilder('pages');

        if (null !== $menuName) {
            $qb->innerJoin('pages.menu', 'menus', Join::WITH, 'menus.name = :menuName');
            $qb->setParameter('menuName', $menuName);
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
     * {@inheritDoc}
     */
    public function getActivePagesQB()
    {
        $qb = $this->repository->createQueryBuilder('pages');

        // Check if the page is active
        $qb->andWhere('pages.publishAt < CURRENT_TIMESTAMP() OR pages.publishAt IS NULL');
        $qb->andWhere('pages.publishTill > CURRENT_TIMESTAMP() OR pages.publishTill IS NULL');

        $qb->orderBy('pages.orderId', 'asc');

        return $qb;
    }

    /**
     * {@inheritDoc}
     */
    public function getActivePages()
    {
        return $this->getActivePagesQB()->getQuery()->getResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getActivePagesFromPage(PageInterface $page)
    {
        $qb = $this->repository->createQueryBuilder('pages');

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
     * {@inheritDoc}
     */
    public function getActivePagesWithMenuTitleFromPage(PageInterface $page)
    {
        $qb = $this->repository->createQueryBuilder('pages');

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
     * {@inheritDoc}
     */
    public function getPageById($pageId)
    {
        $qb = $this->repository->createQueryBuilder('pages');

        $qb->where('pages.id = :pageId');
        $qb->setParameter('pageId', intval($pageId));

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getPageByPermalink($permalink)
    {
        $qb = $this->repository->createQueryBuilder('pages');

        $qb->where('pages.permalink = :permalink');
        $qb->setParameter('permalink', $permalink);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getAllPages()
    {
        $qb = $this->repository->createQueryBuilder('pages');

        $qb->orderBy('pages.orderId', 'asc');

        return $qb->getQuery()->getResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getAllParentPages()
    {
        $qb = $this->repository->createQueryBuilder('pages');

        $qb->where('pages.parent IS NULL');
        $qb->orderBy('pages.orderId', 'asc');

        return $qb->getQuery()->getResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getAllLoosePages()
    {
        $qb = $this->repository->createQueryBuilder('pages');

        $qb->where('pages.parent IS NULL');
        $qb->andWhere('pages.menu IS NULL');

        $qb->orderBy('pages.orderId', 'asc');

        return $qb->getQuery()->getResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getAllChildPages(PageInterface $parentPage)
    {
        $qb = $this->repository->createQueryBuilder('pages');

        $qb->where('pages.parent = :parentPage');
        $qb->setParameter('parentPage', $parentPage);

        $qb->orderBy('pages.orderId', 'asc');

        return $qb->getQuery()->getResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getAllChildablePagesQB()
    {
        $qb = $this->repository->createQueryBuilder('pages');

        $qb->innerJoin('pages.pageType', 'pageType', Join::WITH, 'pageType.hasChildren = true');

        return $qb;
    }

    /**
     * {@inheritDoc}
     */
    public function getAllChildablePages()
    {
        $qb = $this->getAllChildablePagesQB();

        return $qb->getQuery()->getResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getAllChildablePagesExceptThisPageQB(PageInterface $exceptThisPage = null)
    {
        $qb = $this->getAllChildablePagesQB();

        if (null !== $exceptThisPage && null !== $exceptThisPage->getId()) {
            $qb->where('pages <> :exceptThisPage');
            $qb->setParameter('exceptThisPage', $exceptThisPage);
        }

        $qb->innerJoin('pages.pageType', 'parentPageType');
        $qb->innerJoin('parentPageType.pageTypeChildren', 'pageTypeChildren', Join::WITH, 'pageTypeChildren = :pageTypeChild');
        $qb->setParameter('pageTypeChild', $exceptThisPage->getPageType());

        return $qb;
    }

    /**
     * {@inheritDoc}
     */
    public function getFirstPagesByPageTypeId($pageTypeId, $nrOfPages)
    {
        $qb = $this->repository->createQueryBuilder('pages');

        $qb->innerJoin('pages.pageType', 'pageType', Join::WITH, 'pageType.id = :pageTypeId');
        $qb->setParameter('pageTypeId', $pageTypeId);

        $qb->orderBy('pages.orderId', 'asc');
        $qb->setMaxResults($nrOfPages);

        return $qb->getQuery()->getResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getNextPermalinkInMenu(PageInterface $activePage)
    {
        $qb = $this->repository->createQueryBuilder('pages');
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
     * {@inheritDoc}
     */
    public function getPreviousPermalinkInMenu(PageInterface $activePage)
    {
        $qb = $this->repository->createQueryBuilder('pages');
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
     * {@inheritDoc}
     */
    public function getLastPageFromParentByPermalink($permalink)
    {
        $qb = $this->repository->createQueryBuilder('pages');

        $qb->innerJoin('pages.parent', 'parent', Join::WITH, 'parent.permalink = :permalink');
        $qb->setParameter('permalink', $permalink);

        $qb->orderBy('pages.orderId', 'desc');
        $qb->setMaxResults(1);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getNewestPageFromParentByPermalink($permalink)
    {
        $qb = $this->repository->createQueryBuilder('pages');

        $qb->innerJoin('pages.parent', 'parent', Join::WITH, 'parent.permalink = :permalink');
        $qb->setParameter('permalink', $permalink);

        $qb->orderBy('pages.createdAt', 'desc');
        $qb->setMaxResults(1);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getLastPagesFromParentByPermalink($permalink, $number)
    {
        $qb = $this->repository->createQueryBuilder('pages');

        $qb->innerJoin('pages.parent', 'parent', Join::WITH, 'parent.permalink = :permalink');
        $qb->setParameter('permalink', $permalink);

        $qb->orderBy('pages.orderId', 'desc');
        $qb->setMaxResults($number);

        return $qb->getQuery()->getResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getNewestPagesFromParentByPermalink($permalink, $number)
    {
        $qb = $this->repository->createQueryBuilder('pages');

        $qb->innerJoin('pages.parent', 'parent', Join::WITH, 'parent.permalink = :permalink');
        $qb->setParameter('permalink', $permalink);

        $qb->orderBy('pages.createdAt', 'desc');
        $qb->setMaxResults($number);

        return $qb->getQuery()->getResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getNextPermalinkFromParentPage(PageInterface $page)
    {
        $parentPage = $page->getParent();

        if (!($parentPage instanceof PageInterface)) {
            return null;
        }

        $qb = $this->repository->createQueryBuilder('pages');
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
     * {@inheritDoc}
     */
    public function getPreviousPermalinkFromParentPage(PageInterface $page)
    {
        $parentPage = $page->getParent();

        if (!($parentPage instanceof PageInterface)) {
            return null;
        }

        $qb = $this->repository->createQueryBuilder('pages');
        $qb->select('pages.permalink');

        $qb->where('pages.parent = :parentPage');
        $qb->setParameter('parentPage', $parentPage);

        if (null !== $parentPage->getPageType()->getChildrenOrderDirection()) {
            $order = trim(strtolower($parentPage->getPageType()->getChildrenOrderDirection()));

            if ('asc' !== $order && 'desc' !== $order) {
                $order = 'asc';
            } elseif ($order === 'asc') {
                $order = 'desc';
            } elseif ($order === 'desc') {
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
     * {@inheritDoc}
     */
    public function getPageCount()
    {
        $qb = $this->repository->createQueryBuilder('pages');

        $qb->select('count(pages.id)');

        return intval($qb->getQuery()->getSingleScalarResult());
    }

    /**
     * {@inheritDoc}
     */
    public function getPageCountByPageType(PageTypeInterface $pageType)
    {
        $qb = $this->repository->createQueryBuilder('pages');

        $qb->select('count(pages.id)');

        $qb->where('pages.pageType = :page_type');
        $qb->setParameter('page_type', $pageType);

        return intval($qb->getQuery()->getSingleScalarResult());
    }
}
