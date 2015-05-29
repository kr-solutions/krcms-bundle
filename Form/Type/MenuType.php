<?php

namespace KRSolutions\Bundle\KRCMSBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * \KRSolutions\Bundle\KRCMSBundle\Form\Type\MenuType
 */
class MenuType extends AbstractType
{

    /**
     * @var string
     */
    private $class;

    /**
     * @param string $class The menu class name
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
            ->add('name', null, array('label' => 'form.type.menu.name.label', 'required' => true, 'error_bubbling' => true))
            ->add('site', null, array('label' => 'form.type.menu.site.label', 'required' => true, 'error_bubbling' => true))
            ->add('description', null, array('label' => 'form.type.menu.description.label', 'required' => false, 'error_bubbling' => true));
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return 'menu';
    }

    /**
     * Set default options
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'translation_domain' => 'KRSolutionsKRCMSBundle',
        ));
    }
}
