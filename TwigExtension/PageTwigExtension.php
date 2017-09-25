<?php

namespace KRSolutions\Bundle\KRCMSBundle\TwigExtension;

use KRSolutions\Bundle\KRCMSBundle\Entity\Page;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * \KRSolutions\KRCMSBundle\TwigExtension\PageTwigExtension
 */
class PageTwigExtension extends \Twig_Extension
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
     * PageTwigExtension constructor
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
            new \Twig_SimpleFunction('krcms_children', array($this, 'childrenFunction')),
        );
    }

    /**
     * Render a slider
     *
     * @param Page   $page
     * @param string $view
     *
     * @return string
     */
    public function childrenFunction($page_name, $view = null, $maxResults = 10)
    {
        $page = $this->getPageRepository()->getPageByPermalink($page_name);

        if ($page->getPageType()->getHasChildren()) {
            $activeChildrenQB = $this->getPageRepository()->getActiveChildrenQB($page);
            $activeChildrenQB->setMaxResults($maxResults);

            $pages = $activeChildrenQB->getQuery()->getResult();

            return $this->renderView($view, array(
                    'children' => $pages,
            ));
        } else {
            return '';
        }
    }

    /**
     * Returns a rendered view.
     *
     * @param string $view       The view name
     * @param array  $parameters An array of parameters to pass to the view
     *
     * @return string The rendered view
     */
    public function renderView($view, array $parameters = array())
    {
        if ($this->container->has('templating')) {
            return $this->container->get('templating')->render($view, $parameters);
        }

        if (!$this->container->has('twig')) {
            throw new \LogicException('You can not use the "renderView" method if the Templating Component or the Twig Bundle are not available.');
        }

        return $this->container->get('twig')->render($view, $parameters);
    }

    /**
     * Get name of twig extension
     *
     * @return string
     */
    public function getName()
    {
        return 'kr_solutions_krcms.page_twig_extension';
    }

    /**
     * Get the Page Repository
     *
     * @return \KRSolutions\Bundle\KRCMSBundle\Repository\PageRepository
     */
    private function getPageRepository()
    {
        return $this->em->getRepository('KRSolutionsKRCMSBundle:Page');
    }
}
