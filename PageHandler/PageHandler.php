<?php

namespace KRSolutions\Bundle\KRCMSBundle\PageHandler;

use KRSolutions\Bundle\KRCMSBundle\Entity\Page;
use KRSolutions\Bundle\KRCMSBundle\Entity\Site;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * \KRSolutions\Bundle\KRCMSBundle\PageHandler\PageHandler
 */
class PageHandler extends Controller implements PageHandlerInterface
{

    /**
     * Handle Page
     *
     * @param Site    $site
     * @param Page    $page
     * @param Request $request
     *
     * @return Response
     */
    public function handlePage(Site $site, Page $page, Request $request)
    {
        return $this->render($page->getPageType()->getTemplate(), array('site' => $site, 'page' => $page));
    }
}
