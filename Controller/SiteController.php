<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * \KRSolutions\Bundle\KRCMSBundle\Controller\SiteController
 */
class SiteController extends AbstractKRCMSController
{

    /**
     * Site index
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
        if (!$this->isGranted($this->container->getParameter('kr_solutions_krcms.management_roles.sites'))) {
            $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('', array(), 'KRSolutionsKRCMSBundle'));

            return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
        }

        $sites = $this->getSiteManager()->getAllSites();

        return $this->render('KRSolutionsKRCMSBundle:Site:index.html.twig', array('sites' => $sites));
    }

    /**
     * Edit site
     *
     * @param Request $request
     * @param int     $siteId
     *
     * @return Response
     */
    public function editAction(Request $request, $siteId = null)
    {
        if (!$this->isGranted($this->container->getParameter('kr_solutions_krcms.management_roles.sites'))) {
            $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('site.edit.failed_not_authorized', array(), 'KRSolutionsKRCMSBundle'));

            return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
        }

        if (null !== $siteId) {
            $site = $this->getSiteManager()->getSiteById($siteId);
            $action = 'edit';
        } else {
            $site = $this->getSiteManager()->createSite();
            $action = 'new';
        }

        if (null === $site) {
            $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('site.site_not_exist', array('%site_id%' => $siteId), 'KRSolutionsKRCMSBundle'));

            return $this->redirect($this->generateUrl('kr_solutions_krcms_sites_index'));
        }

        $siteForm = $this->createForm('krcms_site', $site);

        $siteForm->handleRequest($request);

        if ($siteForm->isValid()) {
            $flashMessages = array();

            if (null === $siteId) {
                $this->getDoctrine()->getManager()->persist($site);

                $flashMessages['alert-success'][] = $this->getTranslator()->trans('site.site_added', array('%site_title%' => $site->getTitle()), 'KRSolutionsKRCMSBundle');
            } else {
                $flashMessages['alert-success'][] = $this->getTranslator()->trans('site.site_edited', array('%site_title%' => $site->getTitle()), 'KRSolutionsKRCMSBundle');
            }
            $this->getDoctrine()->getManager()->flush();

            foreach ($flashMessages as $type => $flashMessage) {
                foreach ($flashMessage as $message) {
                    $this->getRequest()->getSession()->getFlashBag()->add($type, $message);
                }
            }

            return $this->redirect($this->generateUrl('kr_solutions_krcms_sites_index'));
        }

        return $this->render('KRSolutionsKRCMSBundle:Site:edit.html.twig', array('siteForm' => $siteForm->createView(), 'site' => $site, 'action' => $action));
    }

    /**
     * Remove site
     *
     * @param Request $request
     * @param int     $siteId
     *
     * @return Response
     */
    public function removeAction(Request $request, $siteId)
    {
        if (!$this->isGranted($this->container->getParameter('kr_solutions_krcms.management_roles.sites'))) {
            $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('site.remove.failed_not_authorized', array('%site_id%' => $siteId), 'KRSolutionsKRCMSBundle'));

            return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
        }

        $site = $this->getSiteManager()->getSiteById($siteId);

        if (null === $site) {
            $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('site.remove.failed_not_exist', array('%site_id%' => $siteId), 'KRSolutionsKRCMSBundle'));

            return $this->redirect($this->generateUrl('kr_solutions_krcms_sites_index'));
        }

        $pageCount = $this->getPageManager()->getPageCountBySite($site);

        if (0 !== $pageCount) {
            $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('site.remove.failed_pages_exist', array('%site_id%' => $siteId), 'KRSolutionsKRCMSBundle'));

            return $this->redirect($this->generateUrl('kr_solutions_krcms_sites_index'));
        }

        $this->getDoctrine()->getManager()->remove($site);
        $this->getDoctrine()->getManager()->flush();

        $request->getSession()->getFlashBag()->add('alert-success', $this->getTranslator()->trans('site.remove.success', array('%site_id%' => $siteId), 'KRSolutionsKRCMSBundle'));

        return $this->redirect($this->generateUrl('kr_solutions_krcms_sites_index'));
    }
}
