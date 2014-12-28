<?php

namespace KRSolutions\Bundle\KRCMSBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


/**
 * \KRSolutions\Bundle\KRCMSBundle\Form\Type\SiteType
 */
class SiteType extends AbstractType
{

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
			->add('permalink', null, array('label' => 'form.type.site.permalink.label', 'required' => true, 'error_bubbling' => true))
			->add('title', null, array('label' => 'form.type.site.title.label', 'required' => true, 'error_bubbling' => true))
			->add('isActive', 'choice', array(
				'label' => 'form.type.site.isActive.label',
				'choices' => array(0 => 'form.type.no', 1 => 'form.type.yes'),
				'required' => true,
				'error_bubbling' => true
			))
			->add('homepage', null, array('label' => 'form.type.site.homepage.label', 'required' => false, 'error_bubbling' => true));
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName()
	{
		return 'site';
	}

	/**
	 * Set default options
	 *
	 * @param OptionsResolverInterface $resolver
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'KRSolutions\Bundle\KRCMSBundle\Entity\Site',
			'translation_domain' => 'KRSolutionsKRCMSBundle'
		));
	}

}
