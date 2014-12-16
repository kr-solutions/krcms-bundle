<?php

namespace KRSolutions\Bundle\KRCMSBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


/**
 * \KRSolutions\KRCMSBundle\Form\Type\PageType
 */
class PageType extends AbstractType
{

	/**
	 * @var \KRSolutions\Bundle\KRCMSBundle\Entity\Page $page
	 */
	private $page;

	/**
	 * PageType constructor
	 *
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\Page $page
	 */
	public function __construct(\KRSolutions\Bundle\KRCMSBundle\Entity\Page $page)
	{
		$this->page = $page;
	}

	/**
	 * Build form
	 *
	 * @param \Symfony\Component\Form\FormBuilderInterface $builder The form builder
	 * @param array                                        $options Options
	 *
	 * @return void
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$page = $this->page;

		$builder->add('title', null, array('label' => 'Titel', 'required' => true, 'error_bubbling' => true));
		$builder->add('truePermalink', null, array('label' => 'Permalink', 'required' => false, 'error_bubbling' => true));

		if (false === $page->getPageType()->getIsChild()) {
			$builder->add('menu', null, array('label' => 'Menu', 'required' => false, 'error_bubbling' => true, 'empty_value' => 'Geen menu (Losse pagina)', 'empty_data' => null,
				'query_builder' => function (\KRSolutions\Bundle\KRCMSBundle\Repository\MenuRepository $repository) use ($page) {
					return $repository->getMenusBySiteQB($page->getSite());
				}));

			$builder->add('menuTitle', null, array('label' => 'Menu titel', 'required' => true, 'error_bubbling' => true));
		}

		if (0 !== count($page->getPageType()->getPageTypeParents())) {
			$parentOptions = array('class' => 'KRSolutions\\Bundle\\KRCMSBundle\\Entity\\Page', 'label' => 'Onderdeel van pagina', 'required' => true, 'error_bubbling' => true, 'empty_value' => false,
				'query_builder' => function (\KRSolutions\Bundle\KRCMSBundle\Repository\PageRepository $repository) use ($page) {
					return $repository->getAllChildablePagesExceptThisPageQB($page);
				});

			if (false === $page->getPageType()->getIsChild()) {
				$parentOptions['empty_value'] = 'Geen onderdeel van pagina (Hoofdpagina)';
				$parentOptions['empty_data'] = null;
				$parentOptions['required'] = false;
			}

			$builder->add('parent', 'entity', $parentOptions);
		}

		if (true === $page->getPageType()->getHasContent()) {
			$builder->add('content', null, array('label' => 'Inhoud', 'required' => false, 'error_bubbling' => true));
		}

		$builder->add('metaDescription', null, array('label' => 'Meta beschrijving', 'required' => false, 'error_bubbling' => true));
	}

	/**
	 * Set default options
	 *
	 * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'KRSolutions\Bundle\KRCMSBundle\Entity\Page',
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
