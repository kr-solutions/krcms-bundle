<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 * \KRSolutions\Bundle\KRCMSBundle\Controller\AdminController
 */
class AdminController extends AbstractKRCMSController
{

    /**
     * menuAction
     *
     * @param string $route      Route for current page
     *
     * @return Response
     */
    public function menuAction($route)
    {
        $managementRoles = array();
        $managementRoles['categories'] = $this->container->getParameter('kr_solutions_krcms.management_roles.categories');
        $managementRoles['menus'] = $this->container->getParameter('kr_solutions_krcms.management_roles.menus');
        $managementRoles['page_types'] = $this->container->getParameter('kr_solutions_krcms.management_roles.page_types');

        return $this->render('KRSolutionsKRCMSBundle::menu.html.twig', array(
                'route' => $route,
                'managementRoles' => $managementRoles,
                'helpDeskEnabled' => $this->container->getParameter('kr_solutions_krcms.helpdesk.enabled'),
        ));
    }
}
