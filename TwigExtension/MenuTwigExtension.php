<?php

namespace KRSolutions\Bundle\KRCMSBundle\TwigExtension;

use Exception;
use KRSolutions\Bundle\KRCMSBundle\Entity\Page;
use KRSolutions\Bundle\KRCMSBundle\Entity\Site;
use KRSolutions\Bundle\KRCMSBundle\Repository\PageRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig_Extension;
use Twig_Function_Method;


/**
 * \KRSolutions\KRCMSBundle\TwigExtension\MenuTwigExtension
 */
class MenuTwigExtension extends Twig_Extension
{

	/**
	 * @var ManagerRegistry
	 */
	private $em;

	/**
	 * @var ContainerInterface
	 */
	private $container;

	/**
	 * MenuTwigExtension constructor
	 *
	 * @param ContainerInterface $container
	 */
	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
		$this->em = $container->get('doctrine')->getManager();
	}

	/**
	 * Get functions
	 *
	 * @return array
	 */
	public function getFunctions()
	{
		return array(
			'menu' => new Twig_Function_Method($this, 'menu'),
			'nextPermalinkInMenu' => new Twig_Function_Method($this, 'nextPermalinkInMenu'),
			'previousPermalinkInMenu' => new Twig_Function_Method($this, 'previousPermalinkInMenu'),
		);
	}

	/**
	 * Build the menu
	 *
	 * @param Site   $site       Site entity
	 * @param string $menuName   Menu name
	 * @param Page   $activePage Active page entity
	 * @param bool   $nested     Is menu nested or plain?
	 * @param string $class      Menu class
	 *
	 * @return string
	 */
	public function menu(Site $site, $menuName = '', Page $activePage = null, $nested = true, $class = '')
	{
		$pages = $this->getPageRepository()->getActivePagesFromSiteAndMenuName($site, $menuName);

		if (trim($class) !== '') {
			$html = '<ul class="' . $class . '">';
		} else {
			$html = '<ul>';
		}

		foreach ($pages as $page) {
			/* @var $page \KRSolutions\Bundle\KRCMSBundle\Entity\Page */
			if ($page->getMenuTitle() !== null && trim($page->getMenuTitle()) != '') {
				$this->renderItem($html, $page, $activePage, $nested);
			}
		}

		$html.= '</ul>';

		return $html;
	}

	/**
	 * Get the next page permalink in the menu
	 *
	 * @param Page $activePage
	 *
	 * @return string|null
	 * @throws Exception
	 */
	public function nextPermalinkInMenu(Page $activePage)
	{
		if (!($activePage instanceof Page)) {
			throw new Exception('Not a Page entity');
		}

		if ($activePage->getParent() instanceof Page) {
			$activePage = $activePage->getParent();
		}

		$nextPermalinkInMenu = $this->getPageRepository()->getNextPermalinkInMenu($activePage);

		if (null === $nextPermalinkInMenu && $activePage->getParent() instanceof Page) {
			$nextPermalinkInMenu = $this->getPageRepository()->getNextPermalinkInMenu($activePage);
		}

		return $nextPermalinkInMenu;
	}

	/**
	 * Get the previous page permalink in the menu
	 *
	 * @param Page $activePage
	 *
	 * @return string|null
	 * @throws Exception
	 */
	public function previousPermalinkInMenu(Page $activePage)
	{
		if (!($activePage instanceof Page)) {
			throw new Exception('Not a Page entity');
		}

		if ($activePage->getParent() instanceof Page) {
			return $activePage->getParent()->getPermalink();
		}

		$previousPermalinkInMenu = $this->getPageRepository()->getPreviousPermalinkInMenu($activePage);

		if (null === $previousPermalinkInMenu && $activePage->getParent() instanceof Page) {
			$previousPermalinkInMenu = $this->getPageRepository()->getPreviousPermalinkInMenu($activePage);
		}

		return $previousPermalinkInMenu;
	}

	/**
	 * Render item
	 *
	 * @param string &$html      HTML to build on
	 * @param Page   $parent     Parent page
	 * @param Page   $activePage Active page
	 * @param bool   $nested     Is menu nested or plain?
	 *
	 * @return bool
	 */
	private function renderItem(&$html, Page $parent, Page $activePage, $nested = true)
	{
		$isActive = false;
		$nestedHtml = '';

		if (true === $nested) {
			$pages = $this->getPageRepository()->getActivePagesWithMenuTitleFromPage($parent);

			if (count($pages) > 0) {
				$nestedHtml.= '<ul>';
				foreach ($pages as $page) {
					$isActive = $this->renderItem($nestedHtml, $page, $activePage, $nested);
				}
				$nestedHtml.= '</ul>';
			}
		}

		if ($activePage == $parent) {
			$isActive = true;
		}

		if (true === $isActive) {
			$html.= '<li class="selected">';
		} else {
			$html.= '<li>';
		}

		$html.= '<a href="' . $this->generateUrl('kr_solutions_krcms_page', array('site_permalink' => $parent->getSite()->getPermalink(), 'permalink' => $parent->getPermalink()), true) . '"><span>' . trim($parent->getMenuTitle()) . '</span></a>';
		$html.= $nestedHtml;
		$html.= '</li>';

		return $isActive;
	}

	/**
	 * Get name of twig extension
	 *
	 * @return string
	 */
	public function getName()
	{
		return 'kr_solutions_krcms.menu_twig_extension';
	}

	/**
	 * Get the Pages Repository
	 *
	 * @return PageRepository
	 */
	private function getPageRepository()
	{
		return $this->em->getRepository('KRSolutionsKRCMSBundle:Page');
	}

	/**
	 * Generates a URL from the given parameters.
	 *
	 * @param string  $route      The name of the route
	 * @param mixed   $parameters An array of parameters
	 * @param Boolean $absolute   Whether to generate an absolute URL
	 *
	 * @return string The generated URL
	 */
	public function generateUrl($route, $parameters = array(), $absolute = false)
	{
		return $this->container->get('router')->generate($route, $parameters, $absolute);
	}

}
