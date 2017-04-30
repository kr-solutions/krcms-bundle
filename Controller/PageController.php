<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use DateTime;
use KRSolutions\Bundle\KRCMSBundle\Form\Type\KRCMSPageType;
use KRSolutions\Bundle\KRCMSBundle\FormHandler\FormHandlerInterface;
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
     * @param int $parentPageId Parent page id
     *
     * @return Response
     */
    public function indexAction(Request $request, $parentPageId = null)
    {
        $menus = $this->getMenuManager()->getAllMenus();

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
            $pages = $this->getPageManager()->getAllLoosePages();
        }

        /**
         * Get pages that can have children
         */
        $childablePages = $this->getPageManager()->getAllChildablePages();

        /**
         * Get the page types that can be linked to this parent page
         */
        $possiblePageTypes = $this->getPageTypeRepository()->getPageTypesByParentPageType($pageType);

        $pageTypes = array();

        foreach ($possiblePageTypes as $pageType) {
            /* @var $pageType PageType */
            if ($pageType->getMaximumToCreate() === null) {
                $pageTypes[] = $pageType;
            } else {
                if ($this->getPageRepository()->getPageCountByPageType($pageType) < $pageType->getMaximumToCreate()) {
                    $pageTypes[] = $pageType;
                }
            }
        }

        return $this->render('KRSolutionsKRCMSBundle:Page:index.html.twig', array(
                'pages' => $pages,
                'menus' => $menus,
                'childablePages' => $childablePages,
                'parentPage' => $parentPage,
                'pageTypes' => $pageTypes,
        ));
    }

    /**
     * Edit page
     *
     * @param Request $request    Request object
     * @param int     $pageId     Page id
     * @param string  $pageTypeId PageType id
     *
     * @return Response
     */
    public function editAction(Request $request, $pageId = null, $pageTypeId = null)
    {
        $now = new DateTime('now');

        if (null === $pageId) {
            $pageType = $this->getPageTypeRepository()->getPageTypeById($pageTypeId);

            if (null === $pageType) {
                $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('page.page_type_not_exist', array(), 'KRSolutionsKRCMSBundle'));

                return $this->redirect($this->generateUrl('kr_solutions_krcms_pages_index'));
            }

            $page = $this->getPageManager()->createPage();
            $page->setPageType($pageType);

            $page->setCreatedBy($this->getUser());
            $page->setPublishAt($now);
            $page->setPublishTill(null);
            $page->setOrderId(0);

            $action = 'new';
            $formAction = $this->generateUrl('kr_solutions_krcms_pages_add', array(
                'pageTypeId' => $pageTypeId,
            ));
        } else {
            $page = $this->getPageManager()->getPageById($pageId);
            $action = 'edit';
            $formAction = $this->generateUrl('kr_solutions_krcms_pages_edit', array(
                'pageId' => $pageId,
            ));

            $pageType = $page->getPageType();
        }

        if (null === $page) {
            $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('page.page_not_exist', array('%page_id%' => $pageId), 'KRSolutionsKRCMSBundle'));

            return $this->redirect($this->generateUrl('kr_solutions_krcms_pages_index'));
        }

//        if ($pageType->getHasHeader()) {
//            if (null === $page->getHeader()) {
//                $page->setHeader(new \KRSolutions\Bundle\KRCMSBundle\Entity\Header());
//            }
//        }

        if (null !== $page->getPageType()->getAdminForm()) {
            if ($this->container->has($page->getPageType()->getAdminForm())) {
                $form = $this->container->get($page->getPageType()->getAdminForm());
                $pageForm = $this->createForm($form, $page, array(
                    'method' => 'POST',
                    'action' => $formAction,
                ));
            } else {
                $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('page.form_type_not_exist', array(), 'KRSolutionsKRCMSBundle'));

                return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
            }
        } else {
            $pageForm = $this->createForm(KRCMSPageType::class, $page, array(
                'method' => 'POST',
                'action' => $formAction,
            ));
        }

        $pageForm->handleRequest($request);

        if (null !== $pageType->getAdminFormHandler()) {
            $validFormHandler = true;

            if ($this->container->has($pageType->getAdminFormHandler())) {
                $formHandler = $this->container->get($pageType->getAdminFormHandler());

                if (false === ($formHandler instanceof FormHandlerInterface)) {
                    $formHandler = null;
                    $validFormHandler = false;
                }
            } else {
                $validFormHandler = false;
            }

            if (false === $validFormHandler) {
                $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('page.form_handler_not_exist', array(), 'KRSolutionsKRCMSBundle'));

                return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
            }
        } else {
            $formHandler = null;
        }

        if ($pageForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $flashMessages = array();

            if (null !== $formHandler) {
                $formHandler->handleForm($pageForm, $request, $page);
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
                $file->setUri(str_replace('/'.$this->container->getParameter('kr_solutions_krcms.upload_dir'), '', $file->getUri()));
            }

            $em->flush();

            foreach ($flashMessages as $type => $flashMessage) {
                foreach ($flashMessage as $message) {
                    $request->getSession()->getFlashBag()->add($type, $message);
                }
            }

            if (null !== $page->getParent()) {
                $parentPageId = $page->getParent()->getId();
            } else {
                $parentPageId = null;
            }

            return $this->redirect($this->generateUrl('kr_solutions_krcms_pages_index', array('parentPageId' => $parentPageId)));
        }

        if (null !== $pageType->getAdminTemplate()) {
            $adminTemplate = $pageType->getAdminTemplate();
        } else {
            $adminTemplate = 'KRSolutionsKRCMSBundle:Page:edit.html.twig';
        }

        return $this->render($adminTemplate, array('page' => $page, 'pageForm' => $pageForm->createView(), 'action' => $action));
    }

    /**
     * Remove page
     *
     * @param Request $request
     * @param int $pageId
     *
     * @return Response
     */
    public function removeAction(Request $request, $pageId)
    {
        $page = $this->getPageManager()->getPageById($pageId);

        if (null === $page) {
            $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('page.remove.failed_not_exist', array('%page_id%' => $pageId), 'KRSolutionsKRCMSBundle'));

            return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
        }

        if (false === $page->getPageType()->isUserGranted($this->getUser())) {
            $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('page.remove.failed_not_authorized', array('%page_id%' => $pageId), 'KRSolutionsKRCMSBundle'));

            return $this->redirect($this->generateUrl('kr_solutions_krcms_pages_index'));
        }

        $this->getDoctrine()->getManager()->remove($page);
        $this->getDoctrine()->getManager()->flush();

        $request->getSession()->getFlashBag()->add('alert-success', $this->getTranslator()->trans('page.remove.success', array('%page_id%' => $pageId), 'KRSolutionsKRCMSBundle'));

        return $this->redirect($this->generateUrl('kr_solutions_krcms_pages_index'));
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
                    $text = $clean.'-'.$uniqueCounter;
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
