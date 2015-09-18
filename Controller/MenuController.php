<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

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
     * @param int     $siteId
     *
     * @return Response
     */
    public function indexAction(Request $request, $siteId)
    {
//		if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
//			$this->getRequest()->getSession()->getFlashBag()->add('alert-danger', 'U bent niet gemachtigd om menu\'s te beheren.');
//
//			return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
//		}

        $site = $this->getSiteManager()->getSiteById($siteId);
        $menus = $this->getMenuManager()->getAllMenusBySite($site);

        $newMenu = $this->getMenuManager()->createMenu();
        $newMenu->setSite($site);
        $menuForm = $this->createForm('krcms_menu', $newMenu);

        $menuForm->handleRequest($request);

        if ($menuForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($newMenu);
            $em->flush();

            $this->getRequest()->getSession()->getFlashBag()->add('alert-success', 'Het menu \''.$newMenu->getName().'\' is toegevoegd!');

            return $this->redirect($this->generateUrl('kr_solutions_krcms_menus_index', array('siteId' => $siteId)));
        }

        return $this->render('KRSolutionsKRCMSBundle:Menu:index.html.twig', array('site' => $site, 'menus' => $menus, 'menuForm' => $menuForm->createView()));
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
//		if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
//			$this->getRequest()->getSession()->getFlashBag()->add('alert-danger', 'U bent niet gemachtigd om menu\'s te beheren.');
//
//			return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
//		}

        $menu = $this->getMenuManager()->getMenuById($menuId);

        if (null === $menu) {
            $this->getRequest()->getSession()->getFlashBag()->add('alert-danger', 'Verwijderen mislukt! Het menu met id \''.$menuId.'\' bestaat niet (meer). Probeer het nog een keer!');
        } else {
            $em = $this->getDoctrine()->getManager();

            $em->remove($menu);
            $em->flush();

            $this->getRequest()->getSession()->getFlashBag()->add('alert-success', 'Het menu met id \''.$menuId.'\' is verwijderd.');
        }

        return $this->redirect($this->generateUrl('kr_solutions_krcms_menus_index', array('siteId' => $menu->getSite()->getId())));
    }

    /**
     * Edit menu
     *
     * @param Request $request Request object
     * @param int     $menuId  Menu id
     *
     * @return Response
     */
    public function editAction(Request $request, $menuId = null)
    {
        if (!$this->isGranted($this->container->getParameter('kr_solutions_krcms.management_roles.menus'))) {
            $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('menu.edit.failed_not_authorized', array(), 'KRSolutionsKRCMSBundle'));

            return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
        }

        if (null !== $menuId) {
            $menu = $this->getMenuManager()->getMenuById($menuId);
            $action = 'edit';
        } else {
            $menu = $this->getMenuManager()->createMenu();
            $action = 'new';
        }

        if (null === $menu) {
            $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('menu.menu_not_exist', array('%menu_id%' => $menuId), 'KRSolutionsKRCMSBundle'));

            return $this->redirect($this->generateUrl('kr_solutions_krcms_menus_index'));
        }

        $menuForm = $this->createForm('krcms_menu', $menu);

        $menuForm->handleRequest($request);

        if ($menuForm->isValid()) {
            $flashMessages = array();

            if (null === $menuId) {
                $this->getDoctrine()->getManager()->persist($menu);

                $flashMessages['alert-success'][] = $this->getTranslator()->trans('menu.menu_added', array('%menu_name%' => $menu->getName()), 'KRSolutionsKRCMSBundle');
            } else {
                $flashMessages['alert-success'][] = $this->getTranslator()->trans('menu.menu_edited', array('%menu_name%' => $menu->getName()), 'KRSolutionsKRCMSBundle');
            }
            $this->getDoctrine()->getManager()->flush();

            foreach ($flashMessages as $type => $flashMessage) {
                foreach ($flashMessage as $message) {
                    $this->getRequest()->getSession()->getFlashBag()->add($type, $message);
                }
            }

            return $this->redirect($this->generateUrl('kr_solutions_krcms_menus_index', array('siteId' => $menu->getSite()->getId())));
        }

        return $this->render('KRSolutionsKRCMSBundle:Menu:edit.html.twig', array('menu' => $menu, 'menuForm' => $menuForm->createView(), 'action' => $action));
    }
}
