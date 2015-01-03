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
	public function editAction(Request $request, $pageTypeId)
	{
		$pageType = $this->getPageTypeRepository()->getPageTypeById($pageTypeId);

		if (null === $pageType) {
			$request->getSession()->getFlashBag()->add('alert-danger', 'Pagina type bestaat niet (meer).');

			return $this->redirect($this->generateUrl('kr_solutions_krcms_page_types_index'));
		}

		$pageTypeForm = $this->createForm('page_type', $pageType);

		$pageTypeForm->handleRequest($request);

		if ($pageTypeForm->isValid()) {
			$this->getDoctrine()->getManager()->flush();

			$request->getSession()->getFlashBag()->add('alert-success', 'Pagina type succesvol gewijzigd.');

			return $this->redirect($this->generateUrl('kr_solutions_krcms_page_types_index'));
		}

		return $this->render('KRSolutionsKRCMSBundle:PageType:edit.html.twig', array('pageType' => $pageType, 'pageTypeForm' => $pageTypeForm->createView()));
	}

}
