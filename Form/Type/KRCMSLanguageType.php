<?php

namespace KRSolutions\Bundle\KRCMSBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\LocaleType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * KRCMSLanguageType
 */
class KRCMSLanguageType extends AbstractType
{

    /**
     * @var string
     */
    private $class;

    /**
     * @param string $class The language class name
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
            ->add('country', CountryType::class, array('label' => 'form.type.language.country.label', 'required' => true, 'error_bubbling' => true))
            ->add('locale', LocaleType::class, array('label' => 'form.type.language.locale.label', 'required' => false, 'error_bubbling' => true));
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
}
