<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use Exception;
use SimpleXMLElement;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Controller to render a page by it's page handler
 */
class DefaultController extends AbstractKRCMSController
{

    /**
     * Get a page
     *
     * @param Request $request       The request object
     * @param string  $permalink     Permalink of the page (or else we asume it's the homepage)
     *
     * @return Response
     * @throws Exception
     * @throws NotFoundHttpException
     */
    public function pageAction(Request $request, $permalink = null)
    {
        $page = $this->getPageRepository()->getActivePageFromPermalink($permalink);

        if (null === $page) {
            $page404 = $this->getPageRepository()->getActivePageFromPermalink('404');
            if (null !== $page404) {
                $response = new Response();

                $response->setContent($this->render('KRSolutionsKRCMSBundle:'.$page404->getId().':page.html.twig', array('page' => $page)));
                $response->setStatusCode(404);

                return $response;
            }

            throw $this->createNotFoundException('Page not found');
        }

        if (!$this->has($page->getPageType()->getPageHandler())) {
            throw new Exception('Page handler service \''.$page->getPageType()->getPageHandler().'\' does not exist');
        }

        /* @var $pageHandler \KRSolutions\Bundle\KRCMSBundle\PageHandler\PageHandlerInterface */
        $pageHandler = $this->get($page->getPageType()->getPageHandler());

        return $pageHandler->handlePage($page, $request);
    }

    /**
     * Get a sitemap
     *
     * @return Response
     */
    public function sitemapAction()
    {
        $pages = $this->getPageRepository()->getActivePages();

        $sitemapXml = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>';
        $urlset = new SimpleXMLElement($sitemapXml);

        foreach ($pages as $page) {
            if ($page->getPermalink() == null || trim($page->getPermalink() == '')) {
                continue;
            }
            $url = $urlset->addChild('url');
            $url->addChild('loc', $this->generateUrl('kr_solutions_krcms_page', array('permalink' => $page->getPermalink()), true));
        }

        $response = new Response();
        $response->headers->set('Content-Type', 'xml');
        $response->setContent($urlset->asXML());

        return $response;
    }
}
