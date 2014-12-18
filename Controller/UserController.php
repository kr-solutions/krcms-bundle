<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use DateTime;
use KRSolutions\Bundle\KRUserBundle\Entity\User;
use KRSolutions\Bundle\KRCMSBundle\Form\Type\UserType;
use Symfony\Component\HttpFoundation\Response;


/**
 * \KRSolutions\Bundle\KRCMSBundle\Controller\UserController
 */
class UserController extends AbstractKRCMSController
{

	/**
	 * User index
	 *
	 * @return Response
	 */
	public function indexAction()
	{
		if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
			$this->getRequest()->getSession()->getFlashBag()->add('alert-error', 'U bent niet gemachtigd om gebruikers te beheren.');

			return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
		}

		$users = $this->getUserRepository()->findAll();

		$newUser = new User();
		$userForm = $this->createForm(new UserType($newUser));
		$userForm->setData($newUser);

		if ($this->getRequest()->getMethod() == 'POST') {
			$userForm->bindRequest($this->getRequest());

			if ($userForm->isValid()) {
				$em = $this->getDoctrine()->getManager();

				$now = new DateTime('now');

				$newUser->setAlgorithm('sha1');
				$newUser->setPassword(sha1($newUser->getPassword()));
				$newUser->setLoginCount(0);
				$newUser->setCreatedAt($now);
				$newUser->setCreatedBy($this->getUser());
				$newUser->setUpdatedAt($now);
				$newUser->setUpdatedBy(null);

				$em->persist($newUser);
				$em->flush();

				$this->getRequest()->getSession()->getFlashBag()->add('alert-success', 'De gebruiker met e-mail adres \'' . $newUser->getEmail() . '\' is toegevoegd!');

				return $this->redirect($this->generateUrl('kr_solutions_krcms_users_index'));
			}
		}

		return $this->render('KRSolutionsKRCMSBundle:Admin:users_index.html.twig', array('users' => $users, 'userForm' => $userForm->createView()));
	}

}
