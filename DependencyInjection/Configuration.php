<?php

namespace KRSolutions\Bundle\KRCMSBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;


/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{

	/**
	 * {@inheritdoc}
	 */
	public function getConfigTreeBuilder()
	{
		$treeBuilder = new TreeBuilder();
		$rootNode = $treeBuilder->root('kr_solutions_krcms');

		$rootNode->children()
			->arrayNode('helpdesk')
				->addDefaultsIfNotSet()
					->children()
						->booleanNode('enabled')->defaultValue(true)->end()
						->scalarNode('contact_name')->defaultValue('webmaster')->cannotBeEmpty()->end()
						->scalarNode('contact_email')->defaultValue('webmaster@example.com')->cannotBeEmpty()->end()
						->scalarNode('from_name')->defaultValue('Helpdesk - example.com')->cannotBeEmpty()->end()
						->scalarNode('noreply_email')->defaultValue('noreply@example.com')->cannotBeEmpty()->end()
				->end();

		// Here you should define the parameters that are allowed to
		// configure your bundle. See the documentation linked above for
		// more information on that topic.

		return $treeBuilder;
	}

}
