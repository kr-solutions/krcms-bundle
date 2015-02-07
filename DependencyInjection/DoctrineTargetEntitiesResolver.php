<?php

namespace KRSolutions\Bundle\KRCMSBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;


/**
 * Resolves given target entities with container parameters.
 */
class DoctrineTargetEntitiesResolver
{

	/**
	 * Resolve
	 *
	 * @param ContainerBuilder $container
	 * @param array            $interfaces
	 *
	 * @throws \RuntimeException
	 */
	public function resolve(ContainerBuilder $container, array $interfaces)
	{
		if (!$container->hasDefinition('doctrine.orm.listeners.resolve_target_entity')) {
			throw new \RuntimeException('Cannot find Doctrine RTEL');
		}

		/* @var $resolveTargetEntityListener \Symfony\Component\DependencyInjection\Definition */
		$resolveTargetEntityListener = $container->findDefinition('doctrine.orm.listeners.resolve_target_entity');

		foreach ($interfaces as $interface => $model) {
			$resolveTargetEntityListener
				->addMethodCall('addResolveTargetEntity', array(
					$this->getInterface($container, '\\KRSolutions\\Bundle\\KRCMSBundle\\Entity\\PageInterface'),
					$this->getClass($container, '\\KRSolutions\\Bundle\\KRCMSBundle\\Entity\\Page'),
					array()
			));
		}

		if (!$resolveTargetEntityListener->hasTag('doctrine.event_listener')) {
			$resolveTargetEntityListener->addTag('doctrine.event_listener', array('event' => 'loadClassMetadata'));
		}
	}

	/**
	 * Get interface
	 *
	 * @param ContainerBuilder $container
	 * @param string           $key
	 *
	 * @return string
	 * @throws \InvalidArgumentException
	 */
	private function getInterface(ContainerBuilder $container, $key)
	{
		if ($container->hasParameter($key)) {
			$key = $container->getParameter($key);
		}

		if (interface_exists($key)) {
			return $key;
		}

		throw new \InvalidArgumentException(sprintf('The interface %s does not exists.', $key));
	}

	/**
	 * Get class
	 *
	 * @param ContainerBuilder $container
	 * @param string           $key
	 *
	 * @return string
	 * @throws \InvalidArgumentException
	 */
	private function getClass(ContainerBuilder $container, $key)
	{
		if ($container->hasParameter($key)) {
			$key = $container->getParameter($key);
		}

		if (class_exists($key)) {
			return $key;
		}

		throw new \InvalidArgumentException(sprintf('The class %s does not exists.', $key));
	}

}
