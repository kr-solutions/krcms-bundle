<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use KRSolutions\Bundle\KRCMSBundle\Entity\SiteInterface;
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
	 * @param Request  $request
	 * @param int|null $siteId
	 *
	 * @return Response
	 */
	public function indexAction(Request $request, $siteId = null)
	{
		/**
		 * @todo Find sites by user
		 */
		$sites = $this->getSiteRepository()->findAll();

		if (0 === count($sites)) {
			$request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('dashboard.no_sites', array(), 'KRSolutionsKRCMSBundle'));

			return $this->redirect($this->generateUrl('kr_solutions_krcms_sites_add'));
		}

		if (null !== $siteId) {
			$activeSite = $this->getSiteRepository()->getSiteById($siteId);
		} else {
			$activeSite = null;
		}

		if (false === ($activeSite instanceof SiteInterface)) {
			/**
			 * @todo Get last selected site from user
			 */
			if (1 === count($sites)) {
				$activeSite = array_pop($sites);

				return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard_site', array('siteId' => $activeSite->getId())));
			} else {
				$activeSite = null;
			}
		}

		return $this->render('KRSolutionsKRCMSBundle:Dashboard:index.html.twig', array('site' => $activeSite));
	}

}
