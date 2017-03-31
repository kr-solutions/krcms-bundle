<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use KRSolutions\Bundle\KRCMSBundle\Form\Type\KRCMSMenuType;
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
        $menus = $this->getMenuManager()->getAllMenus();
        $flashMessages = array();

        $newMenu = $this->getMenuManager()->createMenu();
        $menuForm = $this->createForm(KRCMSMenuType::class, $newMenu, array(
            'method' => 'POST',
            'action' => $this->generateUrl('kr_solutions_krcms_menus_index'),
        ));

        $menuForm->handleRequest($request);

        if ($menuForm->isSubmitted() && $menuForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($newMenu);
            $em->flush();

            $flashMessages['alert-success'][] = $this->getTranslator()->trans('menu.menu_added', array('%menu_name%' => $newMenu->getName()), 'KRSolutionsKRCMSBundle');

            foreach ($flashMessages as $type => $flashMessage) {
                foreach ($flashMessage as $message) {
                    $request->getSession()->getFlashBag()->add($type, $message);
                }
            }

            return $this->redirect($this->generateUrl('kr_solutions_krcms_menus_index'));
        }

        return $this->render('KRSolutionsKRCMSBundle:Menu:index.html.twig', array('menus' => $menus, 'menuForm' => $menuForm->createView()));
    }

    /**
     * Remove menu
     *
     * @param Request $request
     * @param int $menuId
     *
     * @return Response
     */
    public function removeAction(Request $request, $menuId)
    {
        $menu = $this->getMenuManager()->getMenuById($menuId);
        $flashMessages = array();

        if (null === $menu) {
            $flashMessages['alert-danger'][] = $this->getTranslator()->trans('menu.remove.failed_not_exist', array('%menu_id%' => $menuId), 'KRSolutionsKRCMSBundle');
        } else {
            $em = $this->getDoctrine()->getManager();

            $em->remove($menu);
            $em->flush();

            $flashMessages['alert-success'][] = $this->getTranslator()->trans('menu.remove.success', array('%menu_id%' => $menuId), 'KRSolutionsKRCMSBundle');
        }

        foreach ($flashMessages as $type => $flashMessage) {
            foreach ($flashMessage as $message) {
                $request->getSession()->getFlashBag()->add($type, $message);
            }
        }

        if (!empty($menu)) {
            return $this->redirect($this->generateUrl('kr_solutions_krcms_menus_index'));
        } else {
            return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
        }
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
            $formAction = $this->generateUrl('kr_solutions_krcms_menus_edit', array(
                'menuId' => $menuId,
            ));
        } else {
            $menu = $this->getMenuManager()->createMenu();
            $action = 'new';
            $formAction = $this->generateUrl('kr_solutions_krcms_menus_add');
        }

        if (null === $menu) {
            $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('menu.menu_not_exist', array('%menu_id%' => $menuId), 'KRSolutionsKRCMSBundle'));

            return $this->redirect($this->generateUrl('kr_solutions_krcms_menus_index'));
        }

        $menuForm = $this->createForm(KRCMSMenuType::class, $menu, array(
            'method' => 'POST',
            'action' => $formAction,
        ));

        $menuForm->handleRequest($request);

        if ($menuForm->isSubmitted() && $menuForm->isValid()) {
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
                    $request->getSession()->getFlashBag()->add($type, $message);
                }
            }

            return $this->redirect($this->generateUrl('kr_solutions_krcms_menus_index'));
        }

        return $this->render('KRSolutionsKRCMSBundle:Menu:edit.html.twig', array('menu' => $menu, 'menuForm' => $menuForm->createView(), 'action' => $action));
    }
}
