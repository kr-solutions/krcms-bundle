<?php

namespace KRSolutions\Bundle\KRCMSBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * KRCMSFileType
 */
class KRCMSFileType extends AbstractType
{

    /**
     * @var string
     */
    private $class;

    /**
     * @param string $class The file class name
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
            ->add('uri', null, array('label' => 'form.type.file.uri.label', 'required' => true, 'error_bubbling' => true))
            ->add('title', null, array('label' => 'form.type.file.title.label', 'required' => false, 'error_bubbling' => true))
            ->add('description', null, array('label' => 'form.type.file.description.label', 'required' => false, 'error_bubbling' => true));
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
        return 'krcms_file';
    }
}
