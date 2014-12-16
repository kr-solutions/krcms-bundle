<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use KRSolutions\Bundle\KRCMSBundle\Repository\CategoryRepository;
use KRSolutions\Bundle\KRCMSBundle\Repository\FileRepository;
use KRSolutions\Bundle\KRCMSBundle\Repository\MenuRepository;
use KRSolutions\Bundle\KRCMSBundle\Repository\PageRepository;
use KRSolutions\Bundle\KRCMSBundle\Repository\PageTypeRepository;
use KRSolutions\Bundle\KRCMSBundle\Repository\SiteRepository;
use KRSolutions\Bundle\KRCMSBundle\Repository\TagRepository;
use KRSolutions\Bundle\KRCMSBundle\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Abstract KRCMS Controller
 */
class AbstractKRCMSController extends Controller
{

	/**
	 * Get Category repository
	 *
	 * @return CategoryRepository
	 */
	protected function getCategoryRepository()
	{
		return $this->getDoctrine()->getRepository('KRSolutionsKRCMSBundle:Category');
	}

	/**
	 * Get the File Repository
	 *
	 * @return FileRepository
	 */
	protected function getFileRepository()
	{
		return $this->getDoctrine()->getRepository('KRSolutionsKRCMSBundle:File');
	}

	/**
	 * Get the Menu Repository
	 *
	 * @return MenuRepository
	 */
	protected function getMenuRepository()
	{
		return $this->getDoctrine()->getRepository('KRSolutionsKRCMSBundle:Menu');
	}

	/**
	 * Get the Page Repository
	 *
	 * @return PageRepository
	 */
	protected function getPageRepository()
	{
		return $this->getDoctrine()->getRepository('KRSolutionsKRCMSBundle:Page');
	}

	/**
	 * Get the PageType Repository
	 *
	 * @return PageTypeRepository
	 */
	protected function getPageTypeRepository()
	{
		return $this->getDoctrine()->getRepository('KRSolutionsKRCMSBundle:PageType');
	}

	/**
	 * Get Site repository
	 *
	 * @return SiteRepository
	 */
	protected function getSiteRepository()
	{
		return $this->getDoctrine()->getRepository('KRSolutionsKRCMSBundle:Site');
	}

	/**
	 * Get Tag repository
	 *
	 * @return TagRepository
	 */
	protected function getTagRepository()
	{
		return $this->getDoctrine()->getRepository('KRSolutionsKRCMSBundle:Tag');
	}

}
