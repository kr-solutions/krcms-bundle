<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use KRSolutions\Bundle\KRCMSBundle\Entity\PageType;
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
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request)
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
        } else {
            $pageType = new PageType();
            $action = 'new';
        }

        if (null === $pageType) {
            $request->getSession()->getFlashBag()->add('alert-danger', 'Pagina type bestaat niet (meer).');

            return $this->redirect($this->generateUrl('kr_solutions_krcms_page_types_index'));
        }

        $pageTypeForm = $this->createForm('page_type', $pageType);

        $pageTypeForm->handleRequest($request);

        if ($pageTypeForm->isValid()) {
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
                    $this->getRequest()->getSession()->getFlashBag()->add($type, $message);
                }
            }

            return $this->redirect($this->generateUrl('kr_solutions_krcms_page_types_index'));
        }

        return $this->render('KRSolutionsKRCMSBundle:PageType:edit.html.twig', array('pageType' => $pageType, 'pageTypeForm' => $pageTypeForm->createView(), 'action' => $action));
    }
}
