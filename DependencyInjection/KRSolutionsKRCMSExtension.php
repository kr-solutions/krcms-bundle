<?php

namespace KRSolutions\Bundle\KRCMSBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;


/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class KRSolutionsKRCMSExtension extends Extension
{

	/**
	 * {@inheritdoc}
	 */
	public function load(array $configs, ContainerBuilder $container)
	{
		$configuration = new Configuration();
		$config = $this->processConfiguration($configuration, $configs);

		/**
		 * Upload directory
		 */
		$container->setParameter('kr_solutions_krcms.upload_dir', $config['upload_dir']);

		/**
		 * Helpdesk
		 */
		$container->setParameter('kr_solutions_krcms.helpdesk.enabled', $config['helpdesk']['enabled']);
		$container->setParameter('kr_solutions_krcms.helpdesk.contact_name', $config['helpdesk']['contact_name']);
		$container->setParameter('kr_solutions_krcms.helpdesk.contact_email', $config['helpdesk']['contact_email']);
		$container->setParameter('kr_solutions_krcms.helpdesk.from_name', $config['helpdesk']['from_name']);
		$container->setParameter('kr_solutions_krcms.helpdesk.noreply_email', $config['helpdesk']['noreply_email']);

		/**
		 * Management roles
		 */
		$container->setParameter('kr_solutions_krcms.management_roles.categories', $config['management_roles']['categories']);
		$container->setParameter('kr_solutions_krcms.management_roles.menus', $config['management_roles']['menus']);
		$container->setParameter('kr_solutions_krcms.management_roles.page_types', $config['management_roles']['page_types']);
		$container->setParameter('kr_solutions_krcms.management_roles.sites', $config['management_roles']['sites']);

		$loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
		$loader->load('services.yml');
	}

}
