<?php

namespace KRSolutions\Bundle\KRCMSBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use KRSolutions\Bundle\KRCMSBundle\DependencyInjection\Compiler\ResolveDoctrineTargetEntitiesPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;


/**
 * K&R Solutions Content Management System Bundle
 */
class KRSolutionsKRCMSBundle extends Bundle
{

	/**
	 * Build
	 *
	 * @param ContainerBuilder $container
	 */
	public function build(ContainerBuilder $container)
	{
		parent::build($container);

		$interfaces = $this->getModelInterfaces();

		if (!empty($interfaces)) {
			$container->addCompilerPass(
				new ResolveDoctrineTargetEntitiesPass($interfaces)
			);
		}
	}

	/**
	 * Get the model interfaces
	 *
	 * @return array
	 */
	protected function getModelInterfaces()
	{
		return array(
			'KRSolutions\\Bundle\\KRCMSBundle\\Entity\\CategoryInterface' => 'kr_solutions_krcms.model.category_class',
			'KRSolutions\\Bundle\\KRCMSBundle\\Entity\\FileInterface' => 'kr_solutions_krcms.model.file_class',
			'KRSolutions\\Bundle\\KRCMSBundle\\Entity\\MenuInterface' => 'kr_solutions_krcms.model.menu_class',
			'KRSolutions\\Bundle\\KRCMSBundle\\Entity\\PageInterface' => 'kr_solutions_krcms.model.page_class',
			'KRSolutions\\Bundle\\KRCMSBundle\\Entity\\PageTypeInterface' => 'kr_solutions_krcms.model.page_type_class',
			'KRSolutions\\Bundle\\KRCMSBundle\\Entity\\SiteInterface' => 'kr_solutions_krcms.model.site_class',
			'KRSolutions\\Bundle\\KRCMSBundle\\Entity\\TagInterface' => 'kr_solutions_krcms.model.tag_class',
			'KRSolutions\\Bundle\\KRCMSBundle\\Entity\\UserInterface' => 'kr_solutions_krcms.model.user_class'
		);
	}

}
