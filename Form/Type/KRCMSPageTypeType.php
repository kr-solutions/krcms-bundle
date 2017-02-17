<?php

namespace KRSolutions\Bundle\KRCMSBundle\Form\Type;

use KRSolutions\Bundle\KRCMSBundle\Form\DataTransformer\NullToEmptyNumberTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
        $nullToEmptyNumberTransformer = new NullToEmptyNumberTransformer();

        $builder->add('name', null, array('label' => 'form.type.pageType.name.label', 'required' => true, 'error_bubbling' => true));
        $builder->add('description', null, array('label' => 'form.type.pageType.description.label', 'required' => false, 'error_bubbling' => true));
        $builder->add('isChild', ChoiceType::class, array(
            'label' => 'form.type.pageType.isChild.label',
            'choices' => array('form.type.no' => 0, 'form.type.yes' => 1),
            'required' => true,
            'error_bubbling' => true,
            'choices_as_values' => true,
        ));
        $builder->add('isMenuItem', ChoiceType::class, array(
            'label' => 'form.type.pageType.isMenuItem.label',
            'choices' => array('form.type.no' => 0, 'form.type.yes' => 1),
            'required' => true,
            'error_bubbling' => true,
            'choices_as_values' => true,
        ));
        $builder->add('hasChildren', ChoiceType::class, array(
            'label' => 'form.type.pageType.hasChildren.label',
            'choices' => array('form.type.no' => 0, 'form.type.yes' => 1),
            'required' => true,
            'error_bubbling' => true,
            'choices_as_values' => true,
        ));
        $builder->add(
            $builder->create('maximumToCreate', null, array('label' => 'form.type.pageType.maximumToCreate.label', 'required' => false, 'error_bubbling' => true))
                ->addModelTransformer($nullToEmptyNumberTransformer)
        );
        $builder->add('hasContent', ChoiceType::class, array(
            'label' => 'form.type.pageType.hasContent.label',
            'choices' => array('form.type.no' => 0, 'form.type.yes' => 1),
            'required' => true,
            'error_bubbling' => true,
            'choices_as_values' => true,
        ));
        $builder->add('hasFiles', ChoiceType::class, array(
            'label' => 'form.type.pageType.hasFiles.label',
            'choices' => array('form.type.no' => 0, 'form.type.yes' => 1),
            'required' => true,
            'error_bubbling' => true,
            'choices_as_values' => true,
        ));
        $builder->add('childrenOrderBy', ChoiceType::class, array(
            'label' => 'form.type.pageType.childrenOrderBy.label',
            'choices' => array(
                'form.type.pageType.childrenOrderBy.choices.orderId' => 'orderId',
                'form.type.pageType.childrenOrderBy.choices.createdAt' => 'createdAt',
                'form.type.pageType.childrenOrderBy.choices.updatedAt' => 'updatedAt',
                'form.type.pageType.childrenOrderBy.choices.title' => 'title',
                'form.type.pageType.childrenOrderBy.choices.permalink' => 'permalink',
            ),
            'required' => true,
            'error_bubbling' => true,
            'choices_as_values' => true,
        ));
        $builder->add('childrenOrderDirection', ChoiceType::class, array(
            'label' => 'form.type.pageType.childrenOrderDirection.label',
            'choices' => array(
                'form.type.pageType.childrenOrderDirection.choices.desc' => 'desc',
                'form.type.pageType.childrenOrderDirection.choices.asc' => 'asc',
            ),
            'required' => true,
            'error_bubbling' => true,
            'choices_as_values' => true,
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
