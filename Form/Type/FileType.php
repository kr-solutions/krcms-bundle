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
	 * @param \Symfony\Component\Form\FormBuilderInterface $builder The form builder
	 * @param array                                        $options Options
	 *
	 * @return void
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('uri', null, array('label' => 'Bestand', 'required' => true, 'error_bubbling' => true))
			->add('title', null, array('label' => 'Titel', 'required' => false, 'error_bubbling' => true))
			->add('description', null, array('label' => 'Omschrijving', 'required' => false, 'error_bubbling' => true));
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
	 * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'KRSolutions\Bundle\KRCMSBundle\Entity\File',
		));
	}

}
