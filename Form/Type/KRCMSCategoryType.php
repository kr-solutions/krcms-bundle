<?php

namespace KRSolutions\Bundle\KRCMSBundle\Form\Type;

use FM\ElfinderBundle\Form\Type\ElFinderType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * \KRSolutions\Bundle\KRCMSBundle\Form\Type\KRCMSCategoryType
 */
class KRCMSCategoryType extends AbstractType
{

    /**
     * @var string
     */
    private $class;

    /**
     * @param string $class The category class name
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
        $builder
            ->add('name', null, array('label' => 'form.type.category.name.label', 'required' => true, 'error_bubbling' => true))
            ->add('imageUri', ElFinderType::class, array(
                'label' => 'form.type.category.imageUri.label',
                'required' => true,
                'error_bubbling' => true,
                'instance' => 'krcms_form',
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
            'data_class' => $this->class,
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
        return 'krcms_category';
    }
}
