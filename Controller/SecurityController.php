<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;


/**
 * Security controller
 */
class SecurityController extends AbstractKRCMSController
{

	/**
	 * Login page for krcms admin
	 *
	 * @return Response
	 */
	public function userLoginAction()
	{
		$request = $this->getRequest();
		$session = $request->getSession();

		// get the login error if there is one
		if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
			$error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
		} else {
			$error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
		}

		return $this->render('KRSolutionsKRCMSBundle:Security:userlogin.html.twig', array(
				// last username entered by the user
				'last_username' => $session->get(SecurityContext::LAST_USERNAME),
				'error' => $error,
		));
	}

}
