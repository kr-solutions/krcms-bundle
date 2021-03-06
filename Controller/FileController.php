<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use KRSolutions\Bundle\KRCMSBundle\Entity\File;
use KRSolutions\Bundle\KRCMSBundle\Form\Type\KRCMSFileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        $webRoot = trim($this->container->getParameter('kr_solutions_krcms.web_root'));

        $page = $this->getPageRepository()->getPageById($pageId);

        if (null === $page) {
            $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('file.page_not_exist', array('%page_id%' => $pageId), 'KRSolutionsKRCMSBundle'));

            return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
        }

        if (false == $page->getPageType()->getHasFiles()) {
            $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('file.page_cannot_contain_files', array(), 'KRSolutionsKRCMSBundle'));

            return $this->redirect($this->generateUrl('kr_solutions_krcms_pages_index'));
        }

        $newFile = new File();
        $fileForm = $this->createForm(KRCMSFileType::class, $newFile);

        $fileForm->handleRequest($request);

        if ($fileForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $uriOrig = trim($newFile->getUri());
            $strippedUri = trim(substr($uriOrig, strpos(trim($uriOrig, '/'), trim($uploadDir, '/')) + strlen(trim($uploadDir, '/')) + 1), '/');

            if (class_exists('\Tinify\Tinify') && !empty($this->container->getParameter('kr_solutions_krcms.tinify_api_key'))) {
                $systemPath = rtrim($webRoot, '/').'/'.trim($uploadDir, '/').'/'.$strippedUri;
                try {
                    \Tinify\setKey($this->container->getParameter('kr_solutions_krcms.tinify_api_key'));
                    \Tinify\validate();

                    $source = \Tinify\fromFile($systemPath);
                    $source->toFile($systemPath);
                } catch (\Tinify\Exception $e) {
                    $request->getSession()->getFlashBag()->add('alert-warning', $this->getTranslator()->trans('tinify.api_key_invalid', array(), 'KRSolutionsKRCMSBundle'));
                }
            }

            $newFile->setUri($strippedUri);
            $newFile->setPage($page);

            $em->persist($newFile);
            $em->flush();

            $request->getSession()->getFlashBag()->add('alert-success', $this->getTranslator()->trans('file.file_added', array(), 'KRSolutionsKRCMSBundle'));

            return $this->redirect($this->generateUrl('kr_solutions_krcms_files', array('pageId' => $pageId)));
        }

        return $this->render('KRSolutionsKRCMSBundle:File:index.html.twig', array('page' => $page, 'uploadDir' => $uploadDir, 'fileForm' => $fileForm->createView()));
    }

    /**
     * Remove file
     *
     * @param Request $request
     *
     * @return Response
     */
    public function removeFileAction(Request $request)
    {
        $response = new Response();

        if ($request->isXmlHttpRequest() === false) {
            $response->setStatusCode(403);

            return $response;
        }

        $em = $this->getDoctrine()->getManager();

        $fileId = intval($request->request->get('file_id'));

        $file = $this->getFileRepository()->find($fileId);

        if ($file == null) {
            $data = array(
                'success' => false,
            );

            $response->setStatusCode(200);
        } else {
            $data = array(
                'file' => $file->getId(),
                'success' => true,
            );

            $em->remove($file);
            $em->flush();

            $response->setStatusCode(200);
        }

        $response->setContent(json_encode($data));

        return $response;
    }
}
