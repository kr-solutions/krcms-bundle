<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use KRSolutions\Bundle\KRCMSBundle\Entity\Site;
use Swift_Message;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * \KRSolutions\Bundle\KRCMSBundle\Controller\AdminController
 */
class AdminController extends AbstractKRCMSController
{

	/**
	 * menuAction
	 *
	 * @param string $route      Route for current page
	 * @param Site   $activeSite Active Site entity
	 *
	 * @return Response
	 */
	public function menuAction($route, Site $activeSite = null)
	{
		$sites = $this->getSiteRepository()->getAllActiveSites();

		return $this->render('KRSolutionsKRCMSBundle:Admin:menu.html.twig', array(
				'activeSite' => $activeSite,
				'sites' => $sites,
				'route' => $route,
				'helpDeskEnabled' => $this->container->getParameter('kr_solutions_krcms.helpdesk.enabled')
		));
	}

	/**
	 * dashboardAction
	 *
	 * @return Response
	 */
	public function dashboardAction()
	{
		return $this->render('KRSolutionsKRCMSBundle:Admin:dashboard.html.twig');
	}

}
