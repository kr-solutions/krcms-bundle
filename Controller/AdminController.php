<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use KRSolutions\Bundle\KRCMSBundle\Entity\Site;
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

		$managementRoles = array();
		$managementRoles['categories'] = $this->container->getParameter('kr_solutions_krcms.management_roles.categories');
		$managementRoles['menus'] = $this->container->getParameter('kr_solutions_krcms.management_roles.menus');
		$managementRoles['page_types'] = $this->container->getParameter('kr_solutions_krcms.management_roles.page_types');
		$managementRoles['sites'] = $this->container->getParameter('kr_solutions_krcms.management_roles.sites');

		return $this->render('KRSolutionsKRCMSBundle::menu.html.twig', array(
				'activeSite' => $activeSite,
				'sites' => $sites,
				'route' => $route,
				'managementRoles' => $managementRoles,
				'helpDeskEnabled' => $this->container->getParameter('kr_solutions_krcms.helpdesk.enabled')
		));
	}

}
