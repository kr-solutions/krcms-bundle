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
		$sites = $this->getSiteRepository()->findAll();

		if (0 === count($sites)) {
			$request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('dashboard.no_sites', array(), 'KRSolutionsKRCMSBundle'));

			return $this->redirect($this->generateUrl('kr_solutions_krcms_sites_add'));
		}

		return $this->render('KRSolutionsKRCMSBundle:Dashboard:index.html.twig');
	}

}
