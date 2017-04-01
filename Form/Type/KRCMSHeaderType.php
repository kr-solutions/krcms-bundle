<?php

namespace KRSolutions\Bundle\KRCMSBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use KRSolutions\Bundle\KRCMSBundle\Entity\Header;
use KRSolutions\Bundle\KRCMSBundle\Entity\Page;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * KRCMSHeaderType
 */
class KRCMSHeaderType extends AbstractType
{

    /**
     * Build form
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array                $options Options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array('label' => 'form.type.header.title.label', 'required' => true, 'error_bubbling' => true))
            ->add('subtitle', null, array('label' => 'form.type.header.subtitle.label', 'required' => true, 'error_bubbling' => true))
            ->add('uri', ElFinderType::class, array(
                'label' => 'form.type.header.uri.label',
                'required' => true,
                'error_bubbling' => true,
                'instance' => 'krcms_form',
            ))
            ->add('linkType', ChoiceType::class, array(
                'label' => 'form.type.header.linkType.label',
                'choices' => array(
                    'form.type.header.linkType.choices.no_link' => 0,
                    'form.type.header.linkType.choices.internal_link' => 1,
                    'form.type.header.linkType.choices.external_link' => 2,
                ),
                'required' => true,
                'error_bubbling' => true,
                'choices_as_values' => true,
            ))
            ->add('linkPage', EntityType::class, array(
                'label' => 'form.type.header.linkPage.label',
                'class' => Page::class,
                'required' => false,
                'error_bubbling' => true,
                'query_builder' => function (EntityRepository $repository) {
                    return $repository->getActivePagesQB();
                },
            ))
            ->add('linkHref', null, array('label' => 'form.type.header.linkHref.label', 'required' => false, 'error_bubbling' => true))
            ->add('linkTarget', ChoiceType::class, array(
                'label' => 'form.type.header.linkTarget.label',
                'choices' => array(
                    'form.type.header.linkTarget.choices._blank' => '_blank',
                    'form.type.header.linkTarget.choices._self' => '_self',
                    'form.type.header.linkTarget.choices._parent' => '_parent',
                    'form.type.header.linkTarget.choices._top' => '_top',
                ),
                'required' => true,
                'error_bubbling' => true,
                'choices_as_values' => true,
            ))
            ->add('linkLabel', null, array('label' => 'form.type.header.linkLabel.label', 'required' => false, 'error_bubbling' => true))
            ->add('linkTitle', null, array('label' => 'form.type.header.linkTitle.label', 'required' => false, 'error_bubbling' => true))
            ->add('linkClass', null, array('label' => 'form.type.header.linkClass.label', 'required' => false, 'error_bubbling' => true))
            ->add('linkId', null, array('label' => 'form.type.header.linkId.label', 'required' => false, 'error_bubbling' => true))
        ;
    }

    /**
     * Set default options
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Header::class,
            'translation_domain' => 'KRSolutionsKRCMSBundle',
        ));
    }
}
