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
     * Get the Header Repository
     *
     * @return \KRSolutions\Bundle\KRCMSBundle\Repository\HeaderRepository
     */
    protected function getHeaderRepository()
    {
        return $this->getDoctrine()->getRepository('KRSolutionsKRCMSBundle:Header');
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
     * Get Slider repository
     *
     * @return \KRSolutions\Bundle\KRCMSBundle\Repository\SliderRepository
     */
    protected function getSliderRepository()
    {
        return $this->getDoctrine()->getRepository('KRSolutionsKRCMSBundle:Slider');
    }

    /**
     * Get Slider image repository
     *
     * @return \KRSolutions\Bundle\KRCMSBundle\Repository\SliderImageRepository
     */
    protected function getSliderImageRepository()
    {
        return $this->getDoctrine()->getRepository('KRSolutionsKRCMSBundle:SliderImage');
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
     * Get the slider manager
     *
     * @return \KRSolutions\Bundle\KRCMSBundle\Model\SliderManagerInterface
     */
    protected function getSliderManager()
    {
        return $this->container->get('kr_solutions_krcms.slider_manager');
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

    /**
     * Get the category manager
     *
     * @return \KRSolutions\Bundle\KRCMSBundle\Model\CategoryManagerInterface
     */
    protected function getCategoryManager()
    {
        return $this->container->get('kr_solutions_krcms.category_manager');
    }
}
