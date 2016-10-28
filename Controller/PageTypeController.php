<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use KRSolutions\Bundle\KRCMSBundle\Entity\PageType;
use KRSolutions\Bundle\KRCMSBundle\Form\Type\KRCMSPageTypeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * PageType controller
 */
class PageTypeController extends AbstractKRCMSController
{

    /**
     * Index page types
     *
     * @return Response
     */
    public function indexAction()
    {
        $pageTypes = $this->getPageTypeRepository()->getAllPageTypes();

        return $this->render('KRSolutionsKRCMSBundle:PageType:index.html.twig', array('pageTypes' => $pageTypes));
    }

    /**
     * Edit page type
     *
     * @param Request $request
     * @param int     $pageTypeId
     *
     * @return Response
     */
    public function editAction(Request $request, $pageTypeId = null)
    {
        if (null !== $pageTypeId) {
            $pageType = $this->getPageTypeRepository()->getPageTypeById($pageTypeId);
            $action = 'edit';
            $formAction = $this->generateUrl('kr_solutions_krcms_page_types_edit', array(
                'pageTypeId' => $pageTypeId,
            ));
        } else {
            $pageType = new PageType();
            $action = 'new';
            $formAction = $this->generateUrl('kr_solutions_krcms_page_types_add');
        }

        if (null === $pageType) {
            $request->getSession()->getFlashBag()->add('alert-danger', 'Pagina type bestaat niet (meer).');

            return $this->redirect($this->generateUrl('kr_solutions_krcms_page_types_index'));
        }

        $pageTypeForm = $this->createForm(KRCMSPageTypeType::class, $pageType, array(
            'method' => 'POST',
            'action' => $formAction,
        ));

        $pageTypeForm->handleRequest($request);

        if ($pageTypeForm->isSubmitted() && $pageTypeForm->isValid()) {
            $flashMessages = array();

            if (null === $pageTypeId) {
                $this->getDoctrine()->getManager()->persist($pageType);

                $flashMessages['alert-success'][] = 'Pagina type is succesvol aangemaakt';
            } else {
                $flashMessages['alert-success'][] = 'Pagina type is succesvol gewijzigd';
            }
            $this->getDoctrine()->getManager()->flush();

            foreach ($flashMessages as $type => $flashMessage) {
                foreach ($flashMessage as $message) {
                    $request->getSession()->getFlashBag()->add($type, $message);
                }
            }

            return $this->redirect($this->generateUrl('kr_solutions_krcms_page_types_index'));
        }

        return $this->render('KRSolutionsKRCMSBundle:PageType:edit.html.twig', array('pageType' => $pageType, 'pageTypeForm' => $pageTypeForm->createView(), 'action' => $action));
    }

    /**
     * Remove page type
     *
     * @param Request $request
     * @param int     $pageTypeId
     *
     * @return Response
     */
    public function removeAction(Request $request, $pageTypeId)
    {
        if (!$this->isGranted($this->container->getParameter('kr_solutions_krcms.management_roles.page_types'))) {
            $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('page_type.remove.failed_not_authorized', array('%page_type_id%' => $pageTypeId), 'KRSolutionsKRCMSBundle'));

            return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
        }

        $pageType = $this->getPageTypeRepository()->getPageTypeById($pageTypeId);

        if (null === $pageType) {
            $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('page_type.remove.failed_not_exist', array('%page_type_id%' => $pageTypeId), 'KRSolutionsKRCMSBundle'));

            return $this->redirect($this->generateUrl('kr_solutions_krcms_page_types_index'));
        }

        $pageCount = $this->getPageManager()->getPageCountByPageType($pageType);

        if (0 !== $pageCount) {
            $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('page_type.remove.failed_pages_exist', array('%page_type_id%' => $pageTypeId), 'KRSolutionsKRCMSBundle'));

            return $this->redirect($this->generateUrl('kr_solutions_krcms_page_types_index'));
        }

        $this->getDoctrine()->getManager()->remove($pageType);
        $this->getDoctrine()->getManager()->flush();

        $request->getSession()->getFlashBag()->add('alert-success', $this->getTranslator()->trans('page_type.remove.success', array('%page_type_id%' => $pageTypeId), 'KRSolutionsKRCMSBundle'));

        return $this->redirect($this->generateUrl('kr_solutions_krcms_page_types_index'));
    }
}
