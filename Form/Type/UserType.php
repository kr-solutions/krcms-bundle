<?php

namespace KRSolutions\Bundle\KRCMSBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


/**
 * \KRSolutions\Bundle\KRCMSBundle\Form\Type\UserType
 */
class UserType extends AbstractType
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
			->add('email', null, array('label' => 'E-mail adres', 'required' => true, 'error_bubbling' => true))
			->add('password', 'password', array('label' => 'Wachtwoord', 'required' => false, 'error_bubbling' => true))
			->add('sites', null, array('label' => 'Sites', 'required' => true, 'error_bubbling' => true))
			->add('privileges', 'entity', array('label' => 'Privileges', 'required' => true, 'error_bubbling' => true, 'expanded' => true, 'multiple' => true,
				'class' => 'KRSolutionsKRCMSBundle:Privilege'))
			->add('isActive', 'choice', array('label' => 'Actief', 'required' => true, 'error_bubbling' => true, 'choices' => array(true => 'Ja', false => 'Nee')));
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName()
	{
		return 'user';
	}

	/**
	 * Set default options
	 *
	 * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'KRSolutions\Bundle\KRUserBundle\Entity\User',
		));
	}

}
