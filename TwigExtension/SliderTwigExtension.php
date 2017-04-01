<?php

namespace KRSolutions\Bundle\KRCMSBundle\TwigExtension;

use Exception;
use KRSolutions\Bundle\KRCMSBundle\Entity\Page;
use KRSolutions\Bundle\KRCMSBundle\Repository\PageRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * \KRSolutions\KRCMSBundle\TwigExtension\SliderTwigExtension
 */
class SliderTwigExtension extends \Twig_Extension
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
            new \Twig_SimpleFunction('slider', array($this, 'sliderFunction')),
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
    public function sliderFunction(Page $page = null, $view = null)
    {
        if ($page->getPageType()->getHasSlider()) {
            $sliderImages = array();

            if (null !== $page->getSlider()) {
                $sliderImages = $this->getSliderImageRepository()->getSliderImagesBySlider($page->getSlider());
            } else {
                $slider = $this->getSliderRepository()->getDefaultSlider();

                if (null !== $slider) {
                    $sliderImages = $this->getSliderImageRepository()->getSliderImagesBySlider($slider);
                }
            }

            return $this->renderView($view, array(
                    'sliderImages' => $sliderImages,
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
        return 'kr_solutions_krcms.slider_twig_extension';
    }

    /**
     * Get the Slider Repository
     *
     * @return \KRSolutions\Bundle\KRCMSBundle\Repository\SliderRepository
     */
    private function getSliderRepository()
    {
        return $this->em->getRepository('KRSolutionsKRCMSBundle:Slider');
    }

    /**
     * Get the Slider image Repository
     *
     * @return \KRSolutions\Bundle\KRCMSBundle\Repository\SliderImageRepository
     */
    private function getSliderImageRepository()
    {
        return $this->em->getRepository('KRSolutionsKRCMSBundle:SliderImage');
    }
}
