<?php

namespace KRSolutions\Bundle\KRCMSBundle\TwigExtension;

use Exception;
use KRSolutions\Bundle\KRCMSBundle\Entity\Page;
use KRSolutions\Bundle\KRCMSBundle\Repository\PageRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * \KRSolutions\KRCMSBundle\TwigExtension\MenuTwigExtension
 */
class MenuTwigExtension extends \Twig_Extension
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
            new \Twig_SimpleFunction('menu', array($this, 'menuFunction')),
            new \Twig_SimpleFunction('nextPermalinkInMenu', array($this, 'nextPermalinkInMenuFunction')),
            new \Twig_SimpleFunction('previousPermalinkInMenu', array($this, 'previousPermalinkInMenuFunction')),
        );
    }

    /**
     * Build the menu
     *
     * @param string $menuName   Menu name
     * @param Page   $activePage Active page entity
     * @param bool   $nested     Is menu nested or plain?
     * @param string $class      Menu class
     *
     * @return string
     */
    public function menuFunction($menuName = '', Page $activePage = null, $nested = true, $class = '')
    {
        $pages = $this->getPageRepository()->getActivePagesFromMenuName($menuName);

        if (trim($class) !== '') {
            $html = '<ul class="'.$class.'" data-type="navbar">';
        } else {
            $html = '<ul data-type="navbar">';
        }

        foreach ($pages as $page) {
            /* @var $page Page */
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
    public function nextPermalinkInMenuFunction(Page $activePage)
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
    public function previousPermalinkInMenuFunction(Page $activePage)
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
     * Generates a URL from the given parameters.
     *
     * @param string $route         The name of the route
     * @param mixed  $parameters    An array of parameters
     * @param int    $referenceType The type of reference (one of the constants in UrlGeneratorInterface)
     *
     * @return string The generated URL
     *
     * @see UrlGeneratorInterface
     */
    public function generateUrl($route, $parameters = array(), $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH)
    {
        return $this->container->get('router')->generate($route, $parameters, $referenceType);
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

        $classes = array();

        if (true === $nested) {
            $pages = $this->getPageRepository()->getActivePagesWithMenuTitleFromPage($parent);

            if (count($pages) > 0) {
                $nestedHtml.= '<ul class="dropdown-menu">';
                foreach ($pages as $page) {
                    $isActive = $this->renderItem($nestedHtml, $page, $activePage, $nested);
                }
                $nestedHtml.= '</ul>';

                $classes[] = 'dropdown';
            }
        }

        if ($activePage == $parent) {
            $isActive = true;
            $classes[] = 'active';
        }

        if (!empty($classes)) {
            $html.= '<li class="'.implode(' ', $classes).'">';
        } else {
            $html.= '<li>';
        }

        $html.= '<a href="'.$this->generateUrl($parent->getRoutes()->first(), array(), UrlGeneratorInterface::ABSOLUTE_URL).'"><span>'.trim($parent->getMenuTitle()).'</span></a>';
        $html.= $nestedHtml;
        $html.= '</li>';

        return $isActive;
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
}
