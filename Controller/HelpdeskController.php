<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use Swift_Message;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Helpdesk controller
 */
class HelpdeskController extends AbstractKRCMSController
{

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

		$form->handleRequest($request);

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

		return $this->render('KRSolutionsKRCMSBundle:Helpdesk:helpdesk.html.twig', array('contactForm' => $form->createView()));
	}

}
