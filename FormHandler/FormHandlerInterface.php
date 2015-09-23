<?php

namespace KRSolutions\Bundle\KRCMSBundle\FormHandler;

/**
 * FormHandler interface
 */
interface FormHandlerInterface
{

    /**
     * Handle form
     *
     * @param \Symfony\Component\Form\Form                         $form
     * @param \Symfony\Component\HttpFoundation\Request            $request
     * @param \KRSolutions\Bundle\KRCMSBundle\Entity\PageInterface $page
     */
    public function handleForm(\Symfony\Component\Form\Form $form, \Symfony\Component\HttpFoundation\Request $request, \KRSolutions\Bundle\KRCMSBundle\Entity\PageInterface $page);
}
