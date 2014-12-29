<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use KRSolutions\Bundle\KRCMSBundle\Entity\File;
use KRSolutions\Bundle\KRCMSBundle\Form\Type\FileType;


/**
 * File controller
 */
class FileController extends AbstractKRCMSController
{

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
		$uploadDir = trim($this->container->getParameter('kr_solutions_krcms.upload_dir'));

		$request->getSession()->set('KCFINDER', array(
			'disabled' => false,
			'uploadURL' => '/' . trim($this->container->getParameter('kr_solutions_krcms.upload_dir'), '/'),
			'uploadDir' => $this->container->getParameter('kernel.root_dir') . '/../web/' . trim($this->container->getParameter('kr_solutions_krcms.upload_dir'), '/')
		));

		$page = $this->getPageRepository()->getPageById($pageId);

		if (null === $page) {
			$this->getRequest()->getSession()->getFlashBag()->add('alert-danger', 'De pagina met id \'' . $pageId . '\' bestaat niet (meer). Probeer het nog eens.');

			return $this->redirect($this->generateUrl('kr_solutions_krcms_pages_index'));
		}

		if (false == $page->getPageType()->getHasFiles()) {
			$this->getRequest()->getSession()->getFlashBag()->add('alert-danger', 'Deze pagina kan geen bestanden bevatten. Probeer het nog eens.');

			return $this->redirect($this->generateUrl('kr_solutions_krcms_pages_index'));
		}

		$newFile = new File();
		$fileForm = $this->createForm('file', $newFile);

		$fileForm->handleRequest($request);

		if ($fileForm->isValid()) {
			$em = $this->getDoctrine()->getManager();

			$uriOrig = trim($newFile->getUri());

			$newFile->setUri(ltrim(ltrim($uriOrig, '/'), ltrim($uploadDir, '/')));
			$newFile->setCreatedBy($this->getUser());
			$newFile->setPage($page);

			$em->persist($newFile);
			$em->flush();

			$this->getRequest()->getSession()->getFlashBag()->add('alert-success', 'Het bestand is toegevoegd!');

			return $this->redirect($this->generateUrl('kr_solutions_krcms_files', array('pageId' => $pageId)));
		}

		return $this->render('KRSolutionsKRCMSBundle:File:index.html.twig', array('page' => $page, 'uploadDir' => $uploadDir, 'fileForm' => $fileForm->createView()));
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

}
