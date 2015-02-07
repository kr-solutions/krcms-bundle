<?php

namespace KRSolutions\Bundle\KRCMSBundle\Form\Type;

use KRSolutions\Bundle\KRCMSBundle\Form\DataTransformer\NullToEmptyStringTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


/**
 * \KRSolutions\KRCMSBundle\Form\Type\PageType
 */
class PageType extends AbstractType
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
		$page = $builder->getData();

		$nullToEmptyStringTransformer = new NullToEmptyStringTransformer();

		$builder->add('title', null, array('label' => 'form.type.page.title.label', 'required' => true, 'error_bubbling' => true));

		$builder->add(
			$builder->create('truePermalink', null, array('label' => 'form.type.page.permalink.label', 'required' => false, 'error_bubbling' => true))
				->addModelTransformer($nullToEmptyStringTransformer));

		if (false === $page->getPageType()->getIsChild()) {
			$builder->add('menu', null, array('label' => 'form.type.page.menu.label', 'required' => false, 'error_bubbling' => true, 'empty_value' => 'form.type.page.menu.empty_value', 'empty_data' => null,
				'query_builder' => function (\Doctrine\ORM\EntityRepository $repository) use ($page) {
					return $repository->getMenusBySiteQB($page->getSite());
				}));

			$builder->add('menuTitle', null, array('label' => 'form.type.page.menuTitle.label', 'required' => true, 'error_bubbling' => true));
		}

		if (0 !== count($page->getPageType()->getPageTypeParents())) {
			$parentOptions = array('class' => $this->class, 'label' => 'form.type.page.parent.label', 'required' => true, 'error_bubbling' => true, 'empty_value' => false,
				'query_builder' => function (\Doctrine\ORM\EntityRepository $repository) use ($page) {
					return $repository->getAllChildablePagesExceptThisPageQB($page);
				});

			if (false === $page->getPageType()->getIsChild()) {
				$parentOptions['empty_value'] = 'form.type.page.parent.empty_value';
				$parentOptions['empty_data'] = null;
				$parentOptions['required'] = false;
			}

			$builder->add('parent', 'entity', $parentOptions);
		}

		if (true === $page->getPageType()->getHasContent()) {
			$builder->add('content', null, array('label' => 'form.type.page.content.label', 'required' => false, 'error_bubbling' => true));
		}

		$builder->add('metaDescription', null, array('label' => 'form.type.page.metaDescription.label', 'required' => false, 'error_bubbling' => true));
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
			'translation_domain' => 'KRSolutionsKRCMSBundle'
		));
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName()
	{
		return 'page';
	}

}
