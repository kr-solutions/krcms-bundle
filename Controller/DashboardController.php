<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Dashboard
 */
class DashboardController extends AbstractKRCMSController
{

    /**
     * Dashboard
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
        return $this->render('KRSolutionsKRCMSBundle:Dashboard:index.html.twig');
    }
}
