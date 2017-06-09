<?php

namespace KRSolutions\Bundle\KRCMSBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * KRCMSSliderType
 */
class KRCMSSliderType extends AbstractType
{

    /**
     * @var string
     */
    private $class;

    /**
     * @param string $class The slider class name
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
            ->add('name', null, array('label' => 'form.type.slider.name.label', 'required' => true, 'error_bubbling' => true))
            ->add('description', null, array('label' => 'form.type.slider.description.label', 'required' => false, 'error_bubbling' => true))
            ->add('isDefault', ChoiceType::class, array(
                'label' => 'form.type.slider.isDefault.label',
                'choices' => array('form.type.no' => 0, 'form.type.yes' => 1),
                'required' => true,
                'error_bubbling' => true,
                'choices_as_values' => true,
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
        return 'krcms_slider';
    }
}
