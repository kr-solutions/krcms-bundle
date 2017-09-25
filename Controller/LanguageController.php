<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use KRSolutions\Bundle\KRCMSBundle\Form\Type\KRCMSLanguageType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * KRSolutions\Bundle\KRCMSBundle\Controller\LanguageController
 */
class LanguageController extends AbstractKRCMSController
{

    /**
     * Language index
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $languages = $this->getLanguageManager()->getAllLanguages();
        $flashMessages = array();

        $newLanguage = $this->getLanguageManager()->createLanguage();
        $languageForm = $this->createForm(KRCMSLanguageType::class, $newLanguage, array(
            'method' => 'POST',
            'action' => $this->generateUrl('kr_solutions_krcms_languages_index'),
        ));

        $languageForm->handleRequest($request);

        if ($languageForm->isSubmitted() && $languageForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($newLanguage);
            $em->flush();

            $flashMessages['alert-success'][] = $this->getTranslator()->trans('language.language_added', array('%language_name%' => $newLanguage->getName()), 'KRSolutionsKRCMSBundle');

            foreach ($flashMessages as $type => $flashMessage) {
                foreach ($flashMessage as $message) {
                    $request->getSession()->getFlashBag()->add($type, $message);
                }
            }

            return $this->redirect($this->generateUrl('kr_solutions_krcms_languages_index'));
        }

        return $this->render('KRSolutionsKRCMSBundle:Language:index.html.twig', array('languages' => $languages, 'languageForm' => $languageForm->createView()));
    }

    /**
     * Remove language
     *
     * @param Request $request
     * @param int $languageId
     *
     * @return Response
     */
    public function removeAction(Request $request, $languageId)
    {
        $language = $this->getLanguageManager()->getLanguageById($languageId);
        $flashMessages = array();

        if (null === $language) {
            $flashMessages['alert-danger'][] = $this->getTranslator()->trans('language.remove.failed_not_exist', array('%language_id%' => $languageId), 'KRSolutionsKRCMSBundle');
        } else {
            $em = $this->getDoctrine()->getManager();

            $em->remove($language);
            $em->flush();

            $flashMessages['alert-success'][] = $this->getTranslator()->trans('language.remove.success', array('%language_id%' => $languageId), 'KRSolutionsKRCMSBundle');
        }

        foreach ($flashMessages as $type => $flashMessage) {
            foreach ($flashMessage as $message) {
                $request->getSession()->getFlashBag()->add($type, $message);
            }
        }

        if (!empty($language)) {
            return $this->redirect($this->generateUrl('kr_solutions_krcms_languages_index'));
        } else {
            return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
        }
    }

    /**
     * Edit language
     *
     * @param Request $request Request object
     * @param int     $languageId  Language id
     *
     * @return Response
     */
    public function editAction(Request $request, $languageId = null)
    {
        if (!$this->isGranted($this->container->getParameter('kr_solutions_krcms.management_roles.languages'))) {
            $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('language.edit.failed_not_authorized', array(), 'KRSolutionsKRCMSBundle'));

            return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
        }

        if (null !== $languageId) {
            $language = $this->getLanguageManager()->getLanguageById($languageId);
            $action = 'edit';
            $formAction = $this->generateUrl('kr_solutions_krcms_languages_edit', array(
                'languageId' => $languageId,
            ));
        } else {
            $language = $this->getLanguageManager()->createLanguage();
            $action = 'new';
            $formAction = $this->generateUrl('kr_solutions_krcms_languages_add');
        }

        if (null === $language) {
            $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('language.language_not_exist', array('%language_id%' => $languageId), 'KRSolutionsKRCMSBundle'));

            return $this->redirect($this->generateUrl('kr_solutions_krcms_languages_index'));
        }

        $languageForm = $this->createForm(KRCMSLanguageType::class, $language, array(
            'method' => 'POST',
            'action' => $formAction,
        ));

        $languageForm->handleRequest($request);

        if ($languageForm->isSubmitted() && $languageForm->isValid()) {
            $flashMessages = array();

            if (null === $languageId) {
                $this->getDoctrine()->getManager()->persist($language);

                $flashMessages['alert-success'][] = $this->getTranslator()->trans('language.language_added', array('%language_name%' => $language->getName()), 'KRSolutionsKRCMSBundle');
            } else {
                $flashMessages['alert-success'][] = $this->getTranslator()->trans('language.language_edited', array('%language_name%' => $language->getName()), 'KRSolutionsKRCMSBundle');
            }
            $this->getDoctrine()->getManager()->flush();

            foreach ($flashMessages as $type => $flashMessage) {
                foreach ($flashMessage as $message) {
                    $request->getSession()->getFlashBag()->add($type, $message);
                }
            }

            return $this->redirect($this->generateUrl('kr_solutions_krcms_languages_index'));
        }

        return $this->render('KRSolutionsKRCMSBundle:Language:edit.html.twig', array('language' => $language, 'languageForm' => $languageForm->createView(), 'action' => $action));
    }
}
