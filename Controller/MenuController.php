<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use KRSolutions\Bundle\KRCMSBundle\Entity\Menu;
use KRSolutions\Bundle\KRCMSBundle\Form\Type\MenuType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * KRSolutions\Bundle\KRCMSBundle\Controller\MenuController
 */
class MenuController extends AbstractKRCMSController
{

	/**
	 * Menu index
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function indexAction(Request $request)
	{
		if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
			$this->getRequest()->getSession()->getFlashBag()->add('alert-error', 'U bent niet gemachtigd om menu\'s te beheren.');

			return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
		}

		$menus = $this->getMenuRepository()->findAll();

		$newMenu = new Menu();
		$menuForm = $this->createForm(new MenuType($newMenu), $newMenu);

		$menuForm->handleRequest($request);

		if ($menuForm->isValid()) {
			$em = $this->getDoctrine()->getManager();

			$em->persist($newMenu);
			$em->flush();

			$this->getRequest()->getSession()->getFlashBag()->add('alert-success', 'Het menu \'' . $newMenu->getName() . '\' is toegevoegd!');

			return $this->redirect($this->generateUrl('kr_solutions_krcms_menus_index'));
		}

		return $this->render('KRSolutionsKRCMSBundle:Admin:menus_index.html.twig', array('menus' => $menus, 'menuForm' => $menuForm->createView()));
	}

	/**
	 * Remove menu
	 *
	 * @param int $menuId
	 *
	 * @return Response
	 */
	public function removeAction($menuId)
	{
		if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
			$this->getRequest()->getSession()->getFlashBag()->add('alert-error', 'U bent niet gemachtigd om menu\'s te beheren.');

			return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
		}

		$menu = $this->getMenuRepository()->getMenuById($menuId);

		if (null === $menu) {
			$this->getRequest()->getSession()->getFlashBag()->add('alert-error', 'Verwijderen mislukt! Het menu met id \'' . $menuId . '\' bestaat niet (meer). Probeer het nog een keer!');
		} else {
			$em = $this->getDoctrine()->getManager();

			$em->remove($menu);
			$em->flush();

			$this->getRequest()->getSession()->getFlashBag()->add('alert-success', 'Het menu met id \'' . $menuId . '\' is verwijderd.');
		}

		return $this->redirect($this->generateUrl('kr_solutions_krcms_menus_index'));
	}

	/**
	 * Edit menu
	 *
	 * @param Request $request Request object
	 * @param int     $menuId  Menu id
	 *
	 * @return Response
	 */
	public function editAction(Request $request, $menuId)
	{
		if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
			$this->getRequest()->getSession()->getFlashBag()->add('alert-error', 'U bent niet gemachtigd om menu\'s te beheren.');

			return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
		}

		$menu = $this->getMenuRepository()->getMenuById($menuId);

		if (null === $menu) {
			$this->getRequest()->getSession()->getFlashBag()->add('alert-error', 'Het menu met id \'' . $menuId . '\' bestaat niet (meer). Probeer het nog een keer!');

			return $this->redirect($this->generateUrl('kr_solutions_krcms_menus_index'));
		}

		$menuForm = $this->createForm(new MenuType($menu), $menu);

		if ($request->isMethod('POST')) {
			$menuForm->bind($request);

			if ($menuForm->isValid()) {
				$em = $this->getDoctrine()->getManager();

				$em->flush();

				$this->getRequest()->getSession()->getFlashBag()->add('alert-success', 'Het menu \'' . $menu->getName() . '\' is gewijzigd!');

				return $this->redirect($this->generateUrl('kr_solutions_krcms_menus_index'));
			}
		}


		return $this->render('KRSolutionsKRCMSBundle:Admin:menus_edit.html.twig', array('menu' => $menu, 'menuForm' => $menuForm->createView()));
	}

}
