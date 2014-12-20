<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use DateTime;
use KRSolutions\Bundle\KRCMSBundle\Entity\File;
use KRSolutions\Bundle\KRCMSBundle\Entity\Page;
use KRSolutions\Bundle\KRCMSBundle\Form\Type\FileType;
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
		$site = $this->getSiteRepository()->find($siteId);

		if (null === $site) {
			$this->getRequest()->getSession()->getFlashBag()->add('alert-error', 'De site waar u de pagina\s van wilt beheren bestaat niet (meer). Ververs de pagina en probeer het nog eens.');

			$this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
		}

		$menus = $this->getMenuRepository()->getAllMenusBySite($site);

		if (null !== $parentPageId) {
			$parentPage = $this->getPageRepository()->find($parentPageId);
			$pages = $this->getPageRepository()->getAllChildPages($parentPage);
		} else {
			$parentPage = null;
			$pages = $this->getPageRepository()->getAllLoosePagesBySite($site);
		}

		$childablePages = $this->getPageRepository()->getAllChildablePagesBySite($site);
//		$childPageTypes = $this->getPageTypeRepository()->getAllPossibleChildPageTypesBySite($site);
		$pageTypes = $this->getPageTypeRepository()->getAllPossibleParentPageTypesBySite($site);
//		$pageTypes = array_merge($childPageTypes, $parentPageTypes);

		return $this->render('KRSolutionsKRCMSBundle:Admin:pages_index.html.twig', array('site' => $site, 'pages' => $pages, 'menus' => $menus, 'childablePages' => $childablePages, 'parentPage' => $parentPage, 'pageTypes' => $pageTypes));
	}

	/**
	 * Edit page
	 *
	 * @param Request $request  Request object
	 * @param int     $siteId   Site id
	 * @param int     $pageId   Page id
	 * @param string  $pageType PageType id
	 *
	 * @return Response
	 */
	public function editAction(Request $request, $siteId = null, $pageId = null, $pageType = null)
	{
		$_SESSION['KCFINDER'] = array();
		$_SESSION['KCFINDER']['disabled'] = false;
		$request->getSession()->set('KCFINDER', array('disabled' => false));

		$now = new DateTime('now');

		if (null === $pageId) {
			$pageType = $this->getPageTypeRepository()->getPageTypeById($pageType);

			if (null === $pageType) {
				$this->getRequest()->getSession()->getFlashBag()->add('alert-error', 'Paginatype bestaat niet. Probeer het nog een keer of neem contact op met uw webdesigner.');

				return $this->redirect($this->generateUrl('kr_solutions_krcms_pages_index'));
			}

			$site = $this->getSiteRepository()->find($siteId);

			if (null === $site) {
				$this->getRequest()->getSession()->getFlashBag()->add('alert-error', 'De site waar u de pagina\s van wilt beheren bestaat niet (meer). Ververs de pagina en probeer het nog eens.');

				return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
			}

			$page = new Page();
			$page->setPageType($pageType);
			$page->setSite($site);

			$page->setCreatedBy($this->getUser());
			$page->setPublishAt($now);
			$page->setPublishTill(null);
			$page->setSite($site);
			$page->setOrderId(0);

			$action = 'new';
		} else {
			$page = $this->getPageRepository()->getPageById($pageId);
			$action = 'edit';

			$pageType = $page->getPageType();

			$site = $page->getSite();
		}

		if (null === $page) {
			$this->getRequest()->getSession()->getFlashBag()->add('alert-error', $pageType->getName() . ' met id \'' . $pageId . '\' bestaat niet (meer). Probeer het nog eens.');

			return $this->redirect($this->generateUrl('kr_solutions_krcms_pages_index'));
		}

		if (null !== $pageType->getAdminForm()) {
			$formClass = 'KRSolutions\Bundle\KRCMSBundle\PageTypeForm\\' . $pageType->getAdminForm();

			if (!class_exists($formClass)) {
				$this->getRequest()->getSession()->getFlashBag()->add('alert-error', 'Het formulier om de pagina te beheren bestaat (nog) niet. Neem contact op met de helpdesk om dit probleem te verhelpen.');

				return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
			}
		} else {
			$formClass = 'KRSolutions\Bundle\KRCMSBundle\Form\Type\PageType';
		}

		$pageForm = $this->createForm(new $formClass($page), $page);
		$pageForm->handleRequest($request);

		if (null !== $pageType->getAdminFormHandler()) {
			$formHandlerClass = 'KRSolutions\Bundle\KRCMSBundle\FormHandler\\' . $pageType->getAdminFormHandler() . 'FormHandler';

			if (!class_exists($formHandlerClass)) {
				$this->getRequest()->getSession()->getFlashBag()->add('alert-error', $formHandlerClass . 'Het object om de pagina correct op te slaan bestaat (nog) niet. Neem contact op met de helpdesk om dit probleem te verhelpen.');

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

				$flashMessages['alert-success'][] = $pageType->getName() . ' \'' . $page->getTitle() . '\' is toegevoegd.';
			} else {
				$page->setUpdatedAt($now);
				$page->setUpdatedBy($this->getUser());

				$flashMessages['alert-success'][] = $pageType->getName() . ' \'' . $page->getTitle() . '\' is gewijzigd.';
			}

			foreach ($page->getFiles() as $file) {
				$file->setUri(str_replace('/' . $this->container->getParameter('upload_dir'), '', $file->getUri()));
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
			$adminTemplate = 'KRSolutionsKRCMSBundle:Admin:pages_edit.html.twig';
		}

		$page->setContent(addslashes(preg_replace("/[\n\r]/", "", $page->getContent())));

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
		$page = $this->getPageRepository()->getPageById($pageId);

		if (null === $page) {
			$this->getRequest()->getSession()->getFlashBag()->add('alert-error', 'Verwijderen mislukt! De pagina met id \'' . $pageId . '\' bestaat niet (meer). Probeer het nog een keer!');

			return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
		}

		$site = $page->getSite();

		if (false === $page->getPageType()->isUserGranted($this->getUser())) {
			$this->getRequest()->getSession()->getFlashBag()->add('alert-error', 'U bent niet gemachtigd om deze pagina te verwijderen.');

			return $this->redirect($this->generateUrl('kr_solutions_krcms_pages_index', array('siteId' => $site->getId())));
		}

		$em = $this->getDoctrine()->getManager();

		$em->remove($page);
		$em->flush();

		$this->getRequest()->getSession()->getFlashBag()->add('alert-success', 'De pagina met id \'' . $pageId . '\' is verwijderd.');

		return $this->redirect($this->generateUrl('kr_solutions_krcms_pages_index', array('siteId' => $site->getId())));
	}

	/**
	 * filesAction
	 *
	 * @param Request $request
	 * @param int     $pageId
	 *
	 * @return Response
	 */
	public function filesAction(Request $request, $pageId)
	{
		$_SESSION['KCFINDER'] = array();
		$_SESSION['KCFINDER']['disabled'] = false;

		$page = $this->getPageRepository()->getPageById($pageId);

		if (null === $page) {
			$this->getRequest()->getSession()->getFlashBag()->add('alert-error', 'De pagina met id \'' . $pageId . '\' bestaat niet (meer). Probeer het nog eens.');

			return $this->redirect($this->generateUrl('kr_solutions_krcms_pages_index'));
		}

		if (false == $page->getPageType()->getHasFiles()) {
			$this->getRequest()->getSession()->getFlashBag()->add('alert-error', 'Deze pagina kan geen bestanden bevatten. Probeer het nog eens.');

			return $this->redirect($this->generateUrl('kr_solutions_krcms_pages_index'));
		}

		$newFile = new File();

		$fileForm = $this->createForm(new FileType($newFile));

		$fileForm->setData($newFile);

		$fileForm->handleRequest($request);


		if ($fileForm->isValid()) {
			$em = $this->getDoctrine()->getManager();

			$newFile->setUri(str_replace('/' . $this->container->getParameter('upload_dir'), '', $newFile->getUri()));
			$newFile->setCreatedBy($this->getUser());
			$newFile->setPage($page);

			$em->persist($newFile);
			$em->flush();

			$this->getRequest()->getSession()->getFlashBag()->add('alert-success', 'Het bestand is toegevoegd!');

			return $this->redirect($this->generateUrl('kr_solutions_krcms_files', array('pageId' => $pageId)));
		}

		return $this->render('KRSolutionsKRCMSBundle:Admin:files.html.twig', array('page' => $page, 'fileForm' => $fileForm->createView()));
	}

	/**
	 * Remove file
	 *
	 * @return Response
	 */
	public function removeFileAction()
	{
		$response = new Response();

		if ($this->getRequest()->isXmlHttpRequest() === false) {
			$response->setStatusCode(403);

			return $response;
		}

		$em = $this->getDoctrine()->getManager();

		$fileId = intval($this->getRequest()->request->get('file_id'));

		$file = $this->getFileRepository()->find($fileId);

		if ($file == null) {
			$data = array(
				'success' => false
			);

			$response->setStatusCode(200);
		} else {
			$data = array(
				'file' => $file->getId(),
				'success' => true
			);

			$em->remove($file);
			$em->flush();

			$response->setStatusCode(200);
		}

		$response->setContent(json_encode($data));

		return $response;
	}

	/**
	 * Generate a permalink for a title
	 *
	 * @return Response
	 */
	public function generatePermalinkAction()
	{
		$request = Request::createFromGlobals();
		if ($request->isXmlHttpRequest()) {
			$text = $request->request->get('text');
			$pageId = $request->request->get('page_id');

			$delimiter = '-';

			setlocale(LC_ALL, 'en_US.UTF8');

			$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
			$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
			$clean = strtolower(trim($clean, '-'));
			$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

			$text = $clean;

			if (empty($text)) {
				return new Response('');
			}

			if ($pageId != 'null') {
				$page = $this->getPageRepository()->getPageById($pageId);
			} else {
				$page = null;
			}
			if ($pageId == 'null' || ($page !== null && $page->getPermalink() != $text)) {
				$uniqueCounter = 1;
				while ($this->getPageRepository()->getPageByPermalink($text) !== null) {
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
	 * @return Response
	 */
	public function changeOrderAction()
	{
		$request = Request::createFromGlobals();
		if ($request->isXmlHttpRequest()) {
			$em = $this->getDoctrine()->getManager();

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

			$em->flush();

			return new Response('success');
		} else {
			return new Response('403', 403);
		}
	}

}
