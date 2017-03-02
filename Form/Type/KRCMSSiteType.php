<?php

namespace KRSolutions\Bundle\KRCMSBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use KRSolutions\Bundle\KRCMSBundle\Entity\SiteInterface;
use KRSolutions\Bundle\KRCMSBundle\Form\DataTransformer\NullToEmptyStringTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * KRCMSSiteType
 */
class KRCMSSiteType extends AbstractType
{

    /**
     * @var string
     */
    private $class;

    /**
     * @param string $class The site class name
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
        $nullToEmptyStringTransformer = new NullToEmptyStringTransformer();

        /* @var $site SiteInterface */
        $site = $builder->getData();

        $builder->add(
            $builder->create('permalink', null, array(
                'label' => 'form.type.site.permalink.label',
                'required' => false,
                'error_bubbling' => true,
            ))->addModelTransformer($nullToEmptyStringTransformer)
        );

        $builder->add('title', null, array(
            'label' => 'form.type.site.title.label',
            'required' => true,
            'error_bubbling' => true,
        ));

        $builder->add('isActive', ChoiceType::class, array(
            'label' => 'form.type.site.isActive.label',
            'choices' => array('form.type.no' => 0, 'form.type.yes' => 1),
            'required' => true,
            'error_bubbling' => true,
            'choices_as_values' => true,
        ));

        if (null !== $site->getId()) {
            $builder->add('homepage', null, array(
                'label' => 'form.type.site.homepage.label',
                'required' => false,
                'error_bubbling' => true,
                'query_builder' => function (EntityRepository $repository) use ($site) {
                    return $repository->getActivePagesFromSiteQB($site);
                },
            ));
        }
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
        return 'krcms_site';
    }
}
