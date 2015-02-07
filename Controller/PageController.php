<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * \KRSolutions\Bundle\KRCMSBundle\Controller\PageController
 */
class PageController extends AbstractKRCMSController
{

	/**
	 * Page index
	 *
	 * @param int $siteId       Site id
	 * @param int $parentPageId Parent page id
	 *
	 * @return Response
	 */
	public function indexAction($siteId, $parentPageId = null)
	{
		$site = $this->getSiteManager()->getSiteById($siteId);

		if (null === $site) {
			$this->getRequest()->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('page.site_not_exist', array(), 'KRSolutionsKRCMSBundle'));

			return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
		}

		$menus = $this->getMenuManager()->getAllMenusBySite($site);

		if (null !== $parentPageId) {
			$parentPage = $this->getPageManager()->getPageById($parentPageId);
			$pageType = $parentPage->getPageType();
			$pages = $this->getPageManager()->getAllChildPages($parentPage);
		} else {
			$parentPage = null;
			$pageType = null;

			/**
			 * Get the single pages (without a parent)
			 */
			$pages = $this->getPageManager()->getAllLoosePagesBySite($site);
		}

		/**
		 * Get pages that can have children
		 */
		$childablePages = $this->getPageManager()->getAllChildablePagesBySite($site);

		/**
		 * Get the page types that can be linked to this parent page
		 */
		$pageTypes = $this->getPageTypeRepository()->getPageTypesByParentPageType($pageType);

		return $this->render('KRSolutionsKRCMSBundle:Page:index.html.twig', array(
				'site' => $site,
				'pages' => $pages,
				'menus' => $menus,
				'childablePages' => $childablePages,
				'parentPage' => $parentPage,
				'pageTypes' => $pageTypes
		));
	}

	/**
	 * Edit page
	 *
	 * @param Request $request    Request object
	 * @param int     $siteId     Site id
	 * @param int     $pageId     Page id
	 * @param string  $pageTypeId PageType id
	 *
	 * @return Response
	 */
	public function editAction(Request $request, $siteId = null, $pageId = null, $pageTypeId = null)
	{
		$_SESSION['KCFINDER'] = array();
		$_SESSION['KCFINDER']['disabled'] = false;
		$_SESSION['KCFINDER']['uploadURL'] = '/' . trim($this->container->getParameter('kr_solutions_krcms.upload_dir'), '/');
		$_SESSION['KCFINDER']['uploadDir'] = $this->container->getParameter('kernel.root_dir') . '/../web/' . trim($this->container->getParameter('kr_solutions_krcms.upload_dir'), '/');

		$now = new DateTime('now');

		if (null === $pageId) {
			$pageType = $this->getPageTypeRepository()->getPageTypeById($pageTypeId);

			if (null === $pageType) {
				$this->getRequest()->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('page.page_type_not_exist', array(), 'KRSolutionsKRCMSBundle'));

				return $this->redirect($this->generateUrl('kr_solutions_krcms_pages_index', array('siteId' => $siteId)));
			}

			$site = $this->getSiteManager()->getSiteById($siteId);

			if (null === $site) {
				$this->getRequest()->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('page.site_not_exist', array(), 'KRSolutionsKRCMSBundle'));

				return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
			}

			$page = $this->getPageManager()->createPage();
			$page->setPageType($pageType);
			$page->setSite($site);

			$page->setCreatedBy($this->getUser());
			$page->setPublishAt($now);
			$page->setPublishTill(null);
			$page->setSite($site);
			$page->setOrderId(0);

			$action = 'new';
		} else {
			$page = $this->getPageManager()->getPageById($pageId);
			$action = 'edit';

			$pageType = $page->getPageType();

			$site = $page->getSite();
		}

		if (null === $page) {
			$this->getRequest()->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('page.page_not_exist', array('%page_id%' => $pageId), 'KRSolutionsKRCMSBundle'));

			return $this->redirect($this->generateUrl('kr_solutions_krcms_pages_index'));
		}

//		if (null !== $pageType->getAdminForm()) {
//			$formClass = 'KRSolutions\Bundle\KRCMSBundle\PageTypeForm\\' . $pageType->getAdminForm();
//
//			if (!class_exists($formClass)) {
//				$this->getRequest()->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('page.form_type_not_exist', array(), 'KRSolutionsKRCMSBundle'));
//
//				return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
//			}
//		} else {
//			$formClass = 'KRSolutions\Bundle\KRCMSBundle\Form\Type\PageType';
//		}

		$pageForm = $this->createForm('page', $page);
		$pageForm->handleRequest($request);

		if (null !== $pageType->getAdminFormHandler()) {
			$formHandlerClass = 'KRSolutions\Bundle\KRCMSBundle\FormHandler\\' . $pageType->getAdminFormHandler() . 'FormHandler';

			if (!class_exists($formHandlerClass)) {
				$this->getRequest()->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('page.form_handler_not_exist', array(), 'KRSolutionsKRCMSBundle'));

				return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
			}

			$formHandler = new $formHandlerClass($pageForm, $request, $page);
		} else {
			$formHandler = null;
		}

		if ($pageForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$flashMessages = array();

			if (null !== $formHandler) {
				$formHandler->handleForm();
			}

			if (null === $pageId) {
				$em->persist($page);

				$flashMessages['alert-success'][] = $this->getTranslator()->trans('page.page_added', array('%page_title%' => $page->getTitle()), 'KRSolutionsKRCMSBundle');
			} else {
				$page->setUpdatedAt($now);
				$page->setUpdatedBy($this->getUser());

				$flashMessages['alert-success'][] = $this->getTranslator()->trans('page.page_edited', array('%page_title%' => $page->getTitle()), 'KRSolutionsKRCMSBundle');
			}

			foreach ($page->getFiles() as $file) {
				$file->setUri(str_replace('/' . $this->container->getParameter('kr_solutions_krcms.upload_dir'), '', $file->getUri()));
			}

			$em->flush();

			foreach ($flashMessages as $type => $flashMessage) {
				foreach ($flashMessage as $message) {
					$this->getRequest()->getSession()->getFlashBag()->add($type, $message);
				}
			}

			if (null !== $page->getParent()) {
				$parentPageId = $page->getParent()->getId();
			} else {
				$parentPageId = null;
			}

			return $this->redirect($this->generateUrl('kr_solutions_krcms_pages_index', array('siteId' => $site->getId(), 'parentPageId' => $parentPageId)));
		}

		if (null !== $pageType->getAdminTemplate()) {
			$adminTemplate = 'KRSolutionsKRCMSBundle:KRCMSPageType:' . $pageType->getAdminTemplate() . '.html.twig';
		} else {
			$adminTemplate = 'KRSolutionsKRCMSBundle:Page:edit.html.twig';
		}

		return $this->render($adminTemplate, array('site' => $site, 'page' => $page, 'pageForm' => $pageForm->createView(), 'action' => $action));
	}

	/**
	 * Remove page
	 *
	 * @param int $pageId
	 *
	 * @return Response
	 */
	public function removeAction($pageId)
	{
		$page = $this->getPageManager()->getPageById($pageId);

		if (null === $page) {
			$this->getRequest()->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('page.remove.failed_not_exist', array('%page_id%' => $pageId), 'KRSolutionsKRCMSBundle'));

			return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
		}

		$site = $page->getSite();

		if (false === $page->getPageType()->isUserGranted($this->getUser())) {
			$this->getRequest()->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('page.remove.failed_not_authorized', array('%page_id%' => $pageId), 'KRSolutionsKRCMSBundle'));

			return $this->redirect($this->generateUrl('kr_solutions_krcms_pages_index', array('siteId' => $site->getId())));
		}

		$this->getDoctrine()->getManager()->remove($page);
		$this->getDoctrine()->getManager()->flush();

		$this->getRequest()->getSession()->getFlashBag()->add('alert-success', $this->getTranslator()->trans('page.remove.success', array('%page_id%' => $pageId), 'KRSolutionsKRCMSBundle'));

		return $this->redirect($this->generateUrl('kr_solutions_krcms_pages_index', array('siteId' => $site->getId())));
	}

	/**
	 * Generate a permalink for a title
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function generatePermalinkAction(Request $request)
	{
		if ($request->isXmlHttpRequest()) {
			$text = $request->request->get('text');
			$pageId = $request->request->get('page_id');

			$delimiter = '-';

			setlocale(LC_ALL, 'en_US.UTF8');

			$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
			$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
			$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
			$clean = strtolower(trim($clean, '-'));

			$text = $clean;

			if (empty($text)) {
				return new Response('');
			}

			if (null !== $pageId) {
				$page = $this->getPageManager()->getPageById($pageId);
			} else {
				$page = null;
			}

			if (null === $pageId || ($page !== null && $page->getPermalink() != $text)) {
				$uniqueCounter = 1;

				while ($this->getPageManager()->getPageByPermalink($text) !== null) {
					$text = $clean . '-' . $uniqueCounter;
					$uniqueCounter++;
				}
			}

			return new Response($text);
		} else {
			return new Response('403', 403);
		}
	}

	/**
	 * Change the order of the pages
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function changeOrderAction(Request $request)
	{
		if ($request->isXmlHttpRequest()) {
			$pagesTable = $request->request->get('pages_table');

			foreach ($pagesTable as $row => $orderValue) {
				if (count($orderItem = explode('.', $orderValue)) == 2) {
					$pageId = intval($orderItem[0]);
					$orderId = intval($row);

					$page = $this->getPageRepository()->getPageById($pageId);

					if (null !== $page) {
						$page->setOrderId($orderId);
					} else {
						return new Response('failure');
					}
				}
			}

			$this->getDoctrine()->getManager()->flush();

			return new Response('success');
		} else {
			return new Response('403', 403);
		}
	}

}
