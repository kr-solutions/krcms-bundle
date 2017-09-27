<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use Exception;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use KRSolutions\Bundle\KRCMSBundle\Entity\Page;
use KRSolutions\Bundle\KRCMSBundle\Repository\PageRepository;
use SimpleXMLElement;
use Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Orm\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Controller to render a page by it's page handler
 */
class DefaultController extends AbstractKRCMSController
{

    /**
     * Get a page
     *
     * @param Request $request The request object
     * @param Page    $page    The page entity
     *
     * @return Response
     * @throws Exception
     * @throws NotFoundHttpException
     */
    public function pageAction(Request $request, Route $routeDocument = null, $contentDocument = null, $template = null, $page = 1)
    {
        /* @var $contentDocument Page */
        if ($contentDocument->getPageType()->getHasChildren()) {
            /* @var $pageRepository PageRepository */
            $pageRepository = $this->getDoctrine()->getRepository('KRSolutionsKRCMSBundle:Page');

            $childrenQB = $pageRepository->getActiveChildrenQB($contentDocument);

            $paginator = $this->get('knp_paginator');
            $children = $paginator->paginate(
                $childrenQB, $page < 1 ? 1 : $page, $contentDocument->getPageType()->getChildrenPerPage() < 1 ? 10 : $contentDocument->getPageType()->getChildrenPerPage()
            );

            /* @var $children SlidingPagination */

            if ($children->getCurrentPageNumber() > 1) {
                $next_page_url = $this->generateUrl($routeDocument->getName(), array(
                    'page' => $children->getCurrentPageNumber() - 1
                ));
            } else {
                $next_page_url = null;
            }

            if ($children->getCurrentPageNumber() < $children->getPageCount()) {
                $prev_page_url = $this->generateUrl($routeDocument->getName(), array(
                    'page' => $children->getCurrentPageNumber() + 1
                ));
            } else {
                $prev_page_url = null;
            }
        } else {
            $children = array();
            $next_page_url = null;
            $prev_page_url = null;
        }

        return $this->render($template, array(
                'page' => $contentDocument,
                'children' => $children,
                'next_page_url' => $next_page_url,
                'prev_page_url' => $prev_page_url,
                'route' => $routeDocument,
        ));
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
            /* @var $page Page */
            $url = $urlset->addChild('url');

            $url->addChild('loc', $this->generateUrl($page->getRoutes()->first()->getName(), array(), UrlGeneratorInterface::ABSOLUTE_URL));
        }

        $response = new Response();
        $response->headers->set('Content-Type', 'xml');
        $response->setContent($urlset->asXML());

        return $response;
    }
}
