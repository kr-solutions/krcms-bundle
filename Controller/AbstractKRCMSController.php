<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Abstract KRCMS Controller
 */
class AbstractKRCMSController extends Controller
{

    /**
     * Get Category repository
     *
     * @return \KRSolutions\Bundle\KRCMSBundle\Repository\CategoryRepository
     */
    protected function getCategoryRepository()
    {
        return $this->getDoctrine()->getRepository('KRSolutionsKRCMSBundle:Category');
    }

    /**
     * Get the File Repository
     *
     * @return \KRSolutions\Bundle\KRCMSBundle\Repository\FileRepository
     */
    protected function getFileRepository()
    {
        return $this->getDoctrine()->getRepository('KRSolutionsKRCMSBundle:File');
    }

    /**
     * Get the Menu Repository
     *
     * @return \KRSolutions\Bundle\KRCMSBundle\Repository\MenuRepository
     */
    protected function getMenuRepository()
    {
        return $this->getDoctrine()->getRepository('KRSolutionsKRCMSBundle:Menu');
    }

    /**
     * Get the Page Repository
     *
     * @return \KRSolutions\Bundle\KRCMSBundle\Repository\PageRepository
     */
    protected function getPageRepository()
    {
        return $this->getDoctrine()->getRepository('KRSolutionsKRCMSBundle:Page');
    }

    /**
     * Get the PageType Repository
     *
     * @return \KRSolutions\Bundle\KRCMSBundle\Repository\PageTypeRepository
     */
    protected function getPageTypeRepository()
    {
        return $this->getDoctrine()->getRepository('KRSolutionsKRCMSBundle:PageType');
    }

    /**
     * Get Site repository
     *
     * @return \KRSolutions\Bundle\KRCMSBundle\Repository\SiteRepository
     */
    protected function getSiteRepository()
    {
        return $this->getDoctrine()->getRepository('KRSolutionsKRCMSBundle:Site');
    }

    /**
     * Get Tag repository
     *
     * @return \KRSolutions\Bundle\KRCMSBundle\Repository\TagRepository
     */
    protected function getTagRepository()
    {
        return $this->getDoctrine()->getRepository('KRSolutionsKRCMSBundle:Tag');
    }

    /**
     * Get the translator
     *
     * @return \Symfony\Component\Translation\TranslatorInterface
     */
    protected function getTranslator()
    {
        return $this->container->get('translator');
    }

    /**
     * Get the site manager
     *
     * @return \KRSolutions\Bundle\KRCMSBundle\Model\SiteManagerInterface
     */
    protected function getSiteManager()
    {
        return $this->container->get('kr_solutions_krcms.site_manager');
    }

    /**
     * Get the page manager
     *
     * @return \KRSolutions\Bundle\KRCMSBundle\Model\PageManagerInterface
     */
    protected function getPageManager()
    {
        return $this->container->get('kr_solutions_krcms.page_manager');
    }

    /**
     * Get the menu manager
     *
     * @return \KRSolutions\Bundle\KRCMSBundle\Model\MenuManagerInterface
     */
    protected function getMenuManager()
    {
        return $this->container->get('kr_solutions_krcms.menu_manager');
    }
}
