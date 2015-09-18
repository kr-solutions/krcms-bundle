<?php

namespace KRSolutions\Bundle\KRCMSBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * KRCMSPageTypeType
 */
class KRCMSPageTypeType extends AbstractType
{

    /**
     * @var string
     */
    private $class;

    /**
     * @param string $class The page type class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

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
        $builder->add('name', null, array('label' => 'form.type.pageType.name.label', 'required' => true, 'error_bubbling' => true));
        $builder->add('description', null, array('label' => 'form.type.pageType.description.label', 'required' => false, 'error_bubbling' => true));
        $builder->add('isChild', 'choice', array(
            'label' => 'form.type.pageType.isChild.label',
            'choices' => array(0 => 'form.type.no', 1 => 'form.type.yes'),
            'required' => true,
            'error_bubbling' => true,
        ));
        $builder->add('hasChildren', 'choice', array(
            'label' => 'form.type.pageType.hasChildren.label',
            'choices' => array(0 => 'form.type.no', 1 => 'form.type.yes'),
            'required' => true,
            'error_bubbling' => true,
        ));
        $builder->add('hasContent', 'choice', array(
            'label' => 'form.type.pageType.hasContent.label',
            'choices' => array(1 => 'form.type.yes', 0 => 'form.type.no'),
            'required' => true,
            'error_bubbling' => true,
        ));
        $builder->add('hasFiles', 'choice', array(
            'label' => 'form.type.pageType.hasFiles.label',
            'choices' => array(1 => 'form.type.yes', 0 => 'form.type.no'),
            'required' => true,
            'error_bubbling' => true,
        ));
        $builder->add('childrenOrderBy', 'choice', array(
            'label' => 'form.type.pageType.childrenOrderBy.label',
            'choices' => array(
                'orderId' => 'form.type.pageType.childrenOrderBy.choices.orderId',
                'createdAt' => 'form.type.pageType.childrenOrderBy.choices.createdAt',
                'updatedAt' => 'form.type.pageType.childrenOrderBy.choices.updatedAt',
                'title' => 'form.type.pageType.childrenOrderBy.choices.title',
                'permalink' => 'form.type.pageType.childrenOrderBy.choices.permalink',
            ),
            'required' => true,
            'error_bubbling' => true,
        ));
        $builder->add('childrenOrderDirection', 'choice', array(
            'label' => 'form.type.pageType.childrenOrderDirection.label',
            'choices' => array(
                'desc' => 'form.type.pageType.childrenOrderDirection.choices.desc',
                'asc' => 'form.type.pageType.childrenOrderDirection.choices.asc',
            ),
            'required' => true,
            'error_bubbling' => true,
        ));
        $builder->add('template', null, array('label' => 'form.type.pageType.template.label', 'required' => false, 'error_bubbling' => true));
        $builder->add('pageHandler', null, array('label' => 'form.type.pageType.pageHandler.label', 'required' => false, 'error_bubbling' => true));
        $builder->add('pageTypeChildren', null, array(
            'label' => 'form.type.pageType.pageTypeChildren.label',
            'required' => false,
            'error_bubbling' => true,
            'multiple' => true,
            'expanded' => true,
        ));
    }

    /**
     * Set default options
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'KRSolutions\Bundle\KRCMSBundle\Entity\PageType',
            'translation_domain' => 'KRSolutionsKRCMSBundle',
        ));
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return 'krcms_page_type';
    }
}
