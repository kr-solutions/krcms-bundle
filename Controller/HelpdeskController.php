<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use Swift_Message;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


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
		if ($this->container->getParameter('kr_solutions_krcms.helpdesk.enabled') === false) {
			$request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('helpdesk.not_enabled', array(), 'KRSolutionsKRCMSBundle'));

			return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
		}

		if (method_exists($this->getUser(), 'getKRCMSUsername')) {
			$username = $this->getUser()->getKRCMSUsername();
		} else {
			$username = $this->getUser()->getUsername();
		}

		$defaultData = array(
			'name' => $username,
			'email' => $this->getUser()->getEmail()
		);

		$form = $this->createFormBuilder($defaultData)
			->add('name', 'text', array(
				'label' => $this->getTranslator()->trans('helpdesk.name', array(), 'KRSolutionsKRCMSBundle'),
				'required' => true,
				'constraints' => array(
					new NotBlank(),
					new Length(array('min' => 3)),
			)))
			->add('subject', 'text', array(
				'label' => $this->getTranslator()->trans('helpdesk.subject', array(), 'KRSolutionsKRCMSBundle'),
				'required' => true,
				'constraints' => array(
					new NotBlank(),
					new Length(array('min' => 3)),
			)))
			->add('email', 'email', array(
				'label' => $this->getTranslator()->trans('helpdesk.email', array(), 'KRSolutionsKRCMSBundle'),
				'required' => true,
				'constraints' => array(
					new NotBlank(),
					new Email(array('checkMX' => true, 'checkHost' => true)),
			)))
			->add('message', 'textarea', array(
				'label' => $this->getTranslator()->trans('helpdesk.question', array(), 'KRSolutionsKRCMSBundle'),
				'required' => true,
				'constraints' => array(
					new NotBlank(),
					new Length(array('min' => 20)),
			)))
			->getForm();

		$form->handleRequest($request);

		if ($form->isValid()) {
			// data is an array with "name", "email", and "message" keys
			$data = $form->getData();

			$message = Swift_Message::newInstance()
				->setSubject($data['subject'])
				->setReplyTo($data['email'], $data['name'])
				->setReturnPath($this->container->getParameter('kr_solutions_krcms.helpdesk.contact_email'), $this->container->getParameter('kr_solutions_krcms.helpdesk.contact_name'))
				->setFrom($this->container->getParameter('kr_solutions_krcms.helpdesk.noreply_email'), $this->container->getParameter('kr_solutions_krcms.helpdesk.from_name'))
				->setTo($this->container->getParameter('kr_solutions_krcms.helpdesk.contact_email'), $this->container->getParameter('kr_solutions_krcms.helpdesk.contact_name'))
				->setBody($data['message']);

			$this->get('mailer')->send($message);

			$request->getSession()->getFlashBag()->add('alert-success', $this->getTranslator()->trans('helpdesk.question_submit_success', array(), 'KRSolutionsKRCMSBundle'));

			return $this->redirect($this->generateUrl('kr_solutions_krcms_helpdesk'));
		}

		return $this->render('KRSolutionsKRCMSBundle:Helpdesk:helpdesk.html.twig', array('contactForm' => $form->createView()));
	}

}
