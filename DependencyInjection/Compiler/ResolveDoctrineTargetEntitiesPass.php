<?php

namespace KRSolutions\Bundle\KRCMSBundle\DependencyInjection\Compiler;

use KRSolutions\Bundle\KRCMSBundle\DependencyInjection\DoctrineTargetEntitiesResolver;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;


/**
 * Resolves given target entities with container parameters.
 */
class ResolveDoctrineTargetEntitiesPass implements CompilerPassInterface
{

	/**
	 * @var array
	 */
	private $interfaces;

	/**
	 * Constructor
	 *
	 * @param array $interfaces
	 */
	public function __construct(array $interfaces)
	{
		$this->interfaces = $interfaces;
	}

	/**
	 * {@inheritdoc}
	 */
	public function process(ContainerBuilder $container)
	{
		$resolver = new DoctrineTargetEntitiesResolver();
		$resolver->resolve($container, $this->interfaces);
	}

}
