<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * \KRSolutions\Bundle\KRCMSBundle\Controller\SiteController
 */
class SiteController extends AbstractKRCMSController
{

	/**
	 * Site index
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function indexAction(Request $request)
	{
		$allSites = $this->getSiteRepository()->getAllSites();

		return $this->render('KRSolutionsKRCMSBundle:Admin:sites_index.html.twig', array('allSites' => $allSites));
	}

}
