<?php

namespace KRSolutions\Bundle\KRCMSBundle\Controller;

use KRSolutions\Bundle\KRCMSBundle\Form\Type\KRCMSSliderType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * KRSolutions\Bundle\KRCMSBundle\Controller\SliderController
 */
class SliderController extends AbstractKRCMSController
{

    /**
     * Slider index
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $sliders = $this->getSliderManager()->getAllSliders();
        $flashMessages = array();

        $newSlider = $this->getSliderManager()->createSlider();
        $sliderForm = $this->createForm(KRCMSSliderType::class, $newSlider, array(
            'method' => 'POST',
            'action' => $this->generateUrl('kr_solutions_krcms_sliders_index'),
        ));

        $sliderForm->handleRequest($request);

        if ($sliderForm->isSubmitted() && $sliderForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($newSlider);
            $em->flush();

            $flashMessages['alert-success'][] = $this->getTranslator()->trans('slider.slider_added', array('%slider_name%' => $newSlider->getName()), 'KRSolutionsKRCMSBundle');

            foreach ($flashMessages as $type => $flashMessage) {
                foreach ($flashMessage as $message) {
                    $request->getSession()->getFlashBag()->add($type, $message);
                }
            }

            return $this->redirect($this->generateUrl('kr_solutions_krcms_sliders_index'));
        }

        return $this->render('KRSolutionsKRCMSBundle:Slider:index.html.twig', array('sliders' => $sliders, 'sliderForm' => $sliderForm->createView()));
    }

    /**
     * Remove slider
     *
     * @param Request $request
     * @param int $sliderId
     *
     * @return Response
     */
    public function removeAction(Request $request, $sliderId)
    {
        $slider = $this->getSliderManager()->getSliderById($sliderId);
        $flashMessages = array();

        if (null === $slider) {
            $flashMessages['alert-danger'][] = $this->getTranslator()->trans('slider.remove.failed_not_exist', array('%slider_id%' => $sliderId), 'KRSolutionsKRCMSBundle');
        } else {
            $em = $this->getDoctrine()->getManager();

            $em->remove($slider);
            $em->flush();

            $flashMessages['alert-success'][] = $this->getTranslator()->trans('slider.remove.success', array('%slider_id%' => $sliderId), 'KRSolutionsKRCMSBundle');
        }

        foreach ($flashMessages as $type => $flashMessage) {
            foreach ($flashMessage as $message) {
                $request->getSession()->getFlashBag()->add($type, $message);
            }
        }

        if (!empty($slider)) {
            return $this->redirect($this->generateUrl('kr_solutions_krcms_sliders_index'));
        } else {
            return $this->redirect($this->generateUrl('kr_solutions_krcms_dashboard'));
        }
    }

    /**
     * Edit slider
     *
     * @param Request $request Request object
     * @param int     $sliderId  Slider id
     *
     * @return Response
     */
    public function editAction(Request $request, $sliderId = null)
    {
        if (null !== $sliderId) {
            $slider = $this->getSliderManager()->getSliderById($sliderId);
            $action = 'edit';
            $formAction = $this->generateUrl('kr_solutions_krcms_sliders_edit', array(
                'sliderId' => $sliderId,
            ));
        } else {
            $slider = $this->getSliderManager()->createSlider();
            $action = 'new';
            $formAction = $this->generateUrl('kr_solutions_krcms_sliders_add');
        }

        if (null === $slider) {
            $request->getSession()->getFlashBag()->add('alert-danger', $this->getTranslator()->trans('slider.slider_not_exist', array('%slider_id%' => $sliderId), 'KRSolutionsKRCMSBundle'));

            return $this->redirect($this->generateUrl('kr_solutions_krcms_sliders_index'));
        }

        $sliderForm = $this->createForm(KRCMSSliderType::class, $slider, array(
            'method' => 'POST',
            'action' => $formAction,
        ));

        $sliderForm->handleRequest($request);

        if ($sliderForm->isSubmitted() && $sliderForm->isValid()) {
            $flashMessages = array();

            if (null === $sliderId) {
                $this->getDoctrine()->getManager()->persist($slider);

                $flashMessages['alert-success'][] = $this->getTranslator()->trans('slider.slider_added', array('%slider_name%' => $slider->getName()), 'KRSolutionsKRCMSBundle');
            } else {
                $flashMessages['alert-success'][] = $this->getTranslator()->trans('slider.slider_edited', array('%slider_name%' => $slider->getName()), 'KRSolutionsKRCMSBundle');
            }
            $this->getDoctrine()->getManager()->flush();

            foreach ($flashMessages as $type => $flashMessage) {
                foreach ($flashMessage as $message) {
                    $request->getSession()->getFlashBag()->add($type, $message);
                }
            }

            return $this->redirect($this->generateUrl('kr_solutions_krcms_sliders_index'));
        }

        return $this->render('KRSolutionsKRCMSBundle:Slider:edit.html.twig', array('slider' => $slider, 'sliderForm' => $sliderForm->createView(), 'action' => $action));
    }
}
