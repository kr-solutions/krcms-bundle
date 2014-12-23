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
	 * @param string  $sitePermalink Permalink of the site (if any)
	 * @param string  $permalink     Permalink of the page (or else we asume it's the homepage)
	 *
	 * @return Response
	 * @throws Exception
	 * @throws NotFoundHttpException
	 */
	public function pageAction(Request $request, $sitePermalink = '', $permalink = null)
	{
		$site = $this->getSiteRepository()->getActiveSiteByPermalink($sitePermalink);

		if (null === $site) {
			if ($this->getSiteRepository()->getSiteByPermalink($sitePermalink) !== null) {
				throw new Exception('Site \'' . $sitePermalink . '\' not active');
			} else {
				throw new Exception('Site \'' . $sitePermalink . '\' not found');
			}
		}

		if (null === $permalink) {
			$page = $site->getHomepage();
		} else {
			$page = $this->getPageRepository()->getActivePageFromSiteAndPermalink($site, $permalink);
			if ($site->getHomepage() === $page) {
				return $this->redirect($this->generateUrl('homepage'));
			}
		}

		if (null === $page) {
			$page404 = $this->getPageRepository()->getActivePageFromSiteAndPermalink($site, '404');
			if (null !== $page404) {
				$response = new Response();

				$response->setContent($this->render('KRSolutionsKRCMSBundle:' . $site->getId() . ':page.html.twig', array('site' => $site, 'page' => $page)));
				$response->setStatusCode(404);

				return $response;
			}

			throw $this->createNotFoundException('Page not found');
		}

		if (!$this->has($page->getPageType()->getPageHandler())) {
			throw new Exception('Page handler service \'' . $page->getPageType()->getPageHandler() . '\' does not exist');
		}

		/* @var $pageHandler \KRSolutions\Bundle\KRCMSBundle\PageHandler\PageHandlerInterface */
		$pageHandler = $this->get($page->getPageType()->getPageHandler());

		return $pageHandler->handlePage($site, $page, $request);
	}

	/**
	 * Get a sitemap
	 *
	 * @param string $permalink
	 *
	 * @return Response
	 * @throws Exception
	 */
	public function sitemapAction($permalink = '')
	{
		$site = $this->getSiteRepository()->getActiveSiteByPermalink($permalink);

		if (null === $site) {
			if ($this->getSiteRepository()->getSiteByPermalink($permalink) !== null) {
				throw new Exception('Site \'' . $permalink . '\' not active');
			} else {
				throw new Exception('Site \'' . $permalink . '\' not found');
			}
		}

		$pages = $this->getPageRepository()->getActivePagesFromSite($site);

		$sitemapXml = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>';
		$urlset = new SimpleXMLElement($sitemapXml);

		foreach ($pages as $page) {
			if ($page !== $site->getHomepage() && ($page->getPermalink() == null || trim($page->getPermalink() == ''))) {
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
