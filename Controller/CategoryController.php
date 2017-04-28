<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use KRSolutions\Bundle\KRCMSBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Category controller
 */
class CategoryController extends AbstractKRCMSController
{

    /**
     * List of all categories
     *
     * @param Request $request
     * @param int     $pageId
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $uploadDir = trim($this->container->getParameter('kr_solutions_krcms.upload_dir'));
        $webRoot = trim($this->container->getParameter('kr_solutions_krcms.web_root'));

        $categories = $this->getCategoryRepository()->findAll();

        $newCategory = new Category();
        $categoryForm = $this->createForm('krcms_category', $newCategory);

        $categoryForm->handleRequest($request);

        if ($categoryForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $uriOrig = trim($newCategory->getImageUri());
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

            $newCategory->setImageUri($strippedUri);

            $em->persist($newCategory);
            $em->flush();

            $request->getSession()->getFlashBag()->add('alert-success', $this->getTranslator()->trans('category.category_added', array(), 'KRSolutionsKRCMSBundle'));

            return $this->redirect($this->generateUrl('kr_solutions_krcms_categories_index'));
        }

        return $this->render('KRSolutionsKRCMSBundle:Category:index.html.twig', array('categories' => $categories, 'uploadDir' => $uploadDir, 'categoryForm' => $categoryForm->createView()));
    }

    /**
     * Remove category
     *
     * @param Request $request
     *
     * @return Response
     */
    public function removeAction(Request $request)
    {
        $response = new Response();

        if ($request->isXmlHttpRequest() === false) {
            $response->setStatusCode(403);

            return $response;
        }

        $em = $this->getDoctrine()->getManager();

        $categoryId = intval($request->request->get('category_id'));

        $category = $this->getCategoryRepository()->find($categoryId);

        if ($category == null) {
            $data = array(
                'success' => false,
            );

            $response->setStatusCode(200);
        } else {
            $data = array(
                'file' => $category->getId(),
                'success' => true,
            );

            $em->remove($category);
            $em->flush();

            $response->setStatusCode(200);
        }

        $response->setContent(json_encode($data));

        return $response;
    }

    /**
     * Edit category
     *
     * @param Request $request
     * @param int     $categoryId
     *
     * @return Response
     */
    public function editAction(Request $request, $categoryId = null)
    {
        if (!$this->isGranted($this->container->getParameter('kr_solutions_krcms.management_roles.categories'))) {
            $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('category.edit.failed_not_authorized', array(), 'KRSolutionsKRCMSBundle'));

            return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
        }

        if (null !== $categoryId) {
            $category = $this->getCategoryRepository()->getCategoryById($categoryId);
            $action = 'edit';
            $formAction = $this->generateUrl('kr_solutions_krcms_categories_edit', array(
                'categoryId' => $categoryId,
            ));
        } else {
            $category = $this->getCategoryManager()->createCategory();
            $action = 'new';
            $formAction = $this->generateUrl('kr_solutions_krcms_categories_add');
        }

        if (null === $category) {
            $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('category.category_not_exist', array('%category_id%' => $categoryId), 'KRSolutionsKRCMSBundle'));

            return $this->redirect($this->generateUrl('kr_solutions_krcms_categories_index'));
        }

        $form = $this->createForm(\KRSolutions\Bundle\KRCMSBundle\Form\Type\KRCMSCategoryType::class, $category, array(
            'method' => 'POST',
            'action' => $formAction,
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $flashMessages = array();

            if (null === $categoryId) {
                $this->getDoctrine()->getManager()->persist($category);

                $flashMessages['alert-success'][] = $this->getTranslator()->trans('category.category_added', array('%category_name%' => $category->getName()), 'KRSolutionsKRCMSBundle');
            } else {
                $flashMessages['alert-success'][] = $this->getTranslator()->trans('category.category_edited', array('%category_name%' => $category->getName()), 'KRSolutionsKRCMSBundle');
            }
            $this->getDoctrine()->getManager()->flush();

            foreach ($flashMessages as $type => $flashMessage) {
                foreach ($flashMessage as $message) {
                    $request->getSession()->getFlashBag()->add($type, $message);
                }
            }

            return $this->redirect($this->generateUrl('kr_solutions_krcms_categories_index'));
        }

        return $this->render('KRSolutionsKRCMSBundle:Category:edit.html.twig', array('category' => $category, 'form' => $form->createView(), 'action' => $action));
    }
}
