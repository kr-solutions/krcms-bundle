<?php

namespace KRSolutions\Bundle\KRCMSBundle\PageHandler;

/**
 * KRSolutions\Bundle\KRCMSBundle\PageHandler\PageHandlerInterface
 */
interface PageHandlerInterface
{

    /**
     * Handle Page
     *
     * @param \KRSolutions\Bundle\KRCMSBundle\Entity\Page $page
     * @param \Symfony\Component\HttpFoundation\Request   $request
     */
    public function handlePage(\KRSolutions\Bundle\KRCMSBundle\Entity\Page $page, \Symfony\Component\HttpFoundation\Request $request);
}
