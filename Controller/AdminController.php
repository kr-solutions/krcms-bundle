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

		return $this->render('KRSolutionsKRCMSBundle:Admin:menu.html.twig', array('activeSite' => $activeSite, 'sites' => $sites, 'route' => $route));
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

	/**
	 * helpdeskAction
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function helpdeskAction(Request $request)
	{
		$defaultData = array(
			'email' => $this->getUser()->getEmail()
		);

		$form = $this->createFormBuilder($defaultData)
			->add('name', 'text', array('label' => 'Naam', 'required' => true))
			->add('subject', 'text', array('label' => 'Onderwerp', 'required' => true))
			->add('email', 'email', array('label' => 'E-mail', 'required' => true))
			->add('message', 'textarea', array('label' => 'Uw vraag', 'required' => true))
			->getForm();

		$form->bind($request);

		if ($form->isValid()) {
			// data is an array with "name", "email", and "message" keys
			$data = $form->getData();

			$message = Swift_Message::newInstance()
				->setSubject('KRCMS Helpdesk vraag met onderwerp: ' . $data['subject'])
				->setReplyTo($data['email'])
				->setReturnPath('r.adamse@kr-solutions.nl')
				->setFrom('no-reply@kr-solutions.nl')
				->setTo('r.adamse@kr-solutions.nl')
				->setBody($data['message']);

			$this->get('mailer')->send($message);

			$request->getSession()->getFlashBag()->add('alert-success', 'Uw vraag is verstuurd en wordt binnen 24 uur behandeld.');

			return $this->redirect($this->generateUrl('kr_solutions_krcms_helpdesk'));
		}

		return $this->render('KRSolutionsKRCMSBundle:Admin:helpdesk.html.twig', array('contactForm' => $form->createView()));
	}

}
