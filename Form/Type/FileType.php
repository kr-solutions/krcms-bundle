<?php

namespace KRSolutions\Bundle\KRCMSBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


/**
 * \KRSolutions\Bundle\KRCMSBundle\Form\Type\FileType
 */
class FileType extends AbstractType
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
			->add('uri', null, array('label' => 'form.type.file.uri.label', 'required' => true, 'error_bubbling' => true))
			->add('title', null, array('label' => 'form.type.file.title.label', 'required' => false, 'error_bubbling' => true))
			->add('description', null, array('label' => 'form.type.file.description.label', 'required' => false, 'error_bubbling' => true));
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName()
	{
		return 'file';
	}

	/**
	 * Set default options
	 *
	 * @param OptionsResolverInterface $resolver
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'KRSolutions\Bundle\KRCMSBundle\Entity\File',
			'translation_domain' => 'KRSolutionsKRCMSBundle'
		));
	}

}
