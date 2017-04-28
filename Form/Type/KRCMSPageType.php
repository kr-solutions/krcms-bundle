<?php

namespace KRSolutions\Bundle\KRCMSBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use KRSolutions\Bundle\KRCMSBundle\Entity\Header;
use KRSolutions\Bundle\KRCMSBundle\Entity\PageInterface;
use KRSolutions\Bundle\KRCMSBundle\Form\DataTransformer\NullToEmptyStringTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * KRCMSPageType
 */
class KRCMSPageType extends AbstractType
{

    /**
     * @var string
     */
    private $class;

    /**
     * @param string $class The page class name
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
        /* @var $page PageInterface */
        $page = $builder->getData();

        $nullToEmptyStringTransformer = new NullToEmptyStringTransformer();

        $builder->add('title', null, array('label' => 'form.type.page.title.label', 'required' => true, 'error_bubbling' => true));

        $builder->add(
            $builder->create('permalink', null, array('label' => 'form.type.page.permalink.label', 'required' => false, 'error_bubbling' => true))
                ->addModelTransformer($nullToEmptyStringTransformer)
        );

        if ($page->getPageType()->getIsMenuItem() && false === $page->getPageType()->getIsChild()) {
            $builder->add('menu', null, array(
                'label' => 'form.type.page.menu.label',
                'required' => false,
                'error_bubbling' => true,
                'placeholder' => 'form.type.page.menu.empty_value',
                'empty_data' => null,
                'query_builder' => function (EntityRepository $repository) {
                    return $repository->getMenusQB();
                },
            ));
        }

        if ($page->getPageType()->getIsMenuItem()) {
            $builder->add('menuTitle', null, array('label' => 'form.type.page.menuTitle.label', 'required' => true, 'error_bubbling' => true));
        }

        if ($page->getPageType()->getHasCategory()) {
            $builder->add('category', null, array('label' => 'form.type.page.category.label', 'required' => true, 'error_bubbling' => true));
        }

        if (0 !== count($page->getPageType()->getPageTypeParents())) {
            $parentOptions = array(
                'class' => $this->class,
                'label' => 'form.type.page.parent.label',
                'required' => true,
                'error_bubbling' => true,
                'empty_data' => false,
                'query_builder' => function (EntityRepository $repository) use ($page) {
                    return $repository->getAllChildablePagesExceptThisPageQB($page);
                },
            );

            if (false === $page->getPageType()->getIsChild()) {
                $parentOptions['empty_data'] = 'form.type.page.parent.empty_value';
//                $parentOptions['empty_data'] = null;
                $parentOptions['required'] = false;
            }

            $builder->add('parent', EntityType::class, $parentOptions);
        }

        if (true === $page->getPageType()->getHasContent()) {
            $builder->add('content', CKEditorType::class, array(
                'label' => 'form.type.page.content.label',
                'required' => false,
                'error_bubbling' => true,
                'config' => array(
                    'filebrowserBrowseRoute' => 'elfinder',
                    'filebrowserBrowseRouteParameters' => array(
                        'instance' => 'krcms_ckeditor',
                    )
                ),
            ));
        }

        if (true === $page->getPageType()->getHasHeader()) {
            $builder->add('header', KRCMSHeaderType::class, array(
                'label' => 'form.type.page.header.label',
                'data_class' => Header::class,
                'required' => false,
                'error_bubbling' => true,
                'empty_data' => null,
            ));
        }

        if (true === $page->getPageType()->getHasSlider()) {
            $builder->add('slider', null, array(
                'label' => 'form.type.page.slider.label',
                'required' => false,
                'error_bubbling' => true,
                'placeholder' => 'form.type.page.slider.empty_value',
                'empty_data' => null,
                'query_builder' => function (EntityRepository $repository) {
                    return $repository->getSlidersQB();
                },
            ));
        }

        $builder->add('metaDescription', null, array('label' => 'form.type.page.metaDescription.label', 'required' => false, 'error_bubbling' => true));
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
        return 'krcms_page';
    }
}
