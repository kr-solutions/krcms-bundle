<?php

namespace KRSolutions\Bundle\KRCMSBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class KRSolutionsKRCMSExtension extends Extension implements PrependExtensionInterface
{

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        /**
         * Entity classes
         */
        $container->setParameter('kr_solutions_krcms.model.category_class', $config['model']['category_class']);
        $container->setParameter('kr_solutions_krcms.model.file_class', $config['model']['file_class']);
        $container->setParameter('kr_solutions_krcms.model.header_class', $config['model']['header_class']);
        $container->setParameter('kr_solutions_krcms.model.language_class', $config['model']['language_class']);
        $container->setParameter('kr_solutions_krcms.model.menu_class', $config['model']['menu_class']);
        $container->setParameter('kr_solutions_krcms.model.page_class', $config['model']['page_class']);
        $container->setParameter('kr_solutions_krcms.model.page_type_class', $config['model']['page_type_class']);
        $container->setParameter('kr_solutions_krcms.model.slider_class', $config['model']['slider_class']);
        $container->setParameter('kr_solutions_krcms.model.slider_image_class', $config['model']['slider_image_class']);
        $container->setParameter('kr_solutions_krcms.model.tag_class', $config['model']['tag_class']);
        $container->setParameter('kr_solutions_krcms.model.user_class', $config['model']['user_class']);

        /**
         * Upload directory
         */
        $container->setParameter('kr_solutions_krcms.upload_dir', $config['upload_dir']);

        /**
         * Web root
         */
        $container->setParameter('kr_solutions_krcms.web_root', $config['web_root']);

        /**
         * Tinify (TinyPNG) API Key
         */
        $container->setParameter('kr_solutions_krcms.tinify_api_key', $config['tinify_api_key']);

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

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/services'));
        $loader->load('services.yml');
        $loader->load('formtypes.yml');
        $loader->load('managers.yml');
        $loader->load('twigextensions.yml');
    }

    /**
     * {@inheritdoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        // get all bundles
        $bundles = $container->getParameter('kernel.bundles');
        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);

        $cmfRoutingBundleConfig = array();
        $ivoryCkEditorConfig = array();
        $fmElfinderConfig = array();

        if (isset($bundles['CmfRoutingBundle'])) {
            $cmfRoutingBundleConfig = array(
                'chain' => array(
                    'routers_by_id' => array(
                        "router.default" => 200,
                        "cmf_routing.dynamic_router" => 100,
                    ),
                ),
                'dynamic' => array(
                    "persistence" => array(
                        "orm" => array(
                            "enabled" => true,
                        ),
                    ),
                ),
            );
        }

        if (isset($bundles['IvoryCKEditorBundle'])) {
            $ivoryCkEditorConfig = array(
            );
        }

        if (isset($bundles['FMElfinderBundle'])) {
            $fmElfinderConfig = array(
                'instances' => array(
                    'krcms_ckeditor' => array(
                        'locale' => $container->getParameter('locale'),
                        'editor' => 'ckeditor',
                        'include_assets' => true,
                        'connector' => array(
                            'roots' => array(
                                'uploads' => array(
                                    'driver' => 'LocalFileSystem',
                                    'path' => $config['upload_dir'],
                                    'upload_allow' => array(
                                        'image/png',
                                        'image/jpg',
                                        'image/jpeg',
                                    ),
                                    'upload_deny' => array(
                                        'all',
                                    ),
                                    'upload_max_size' => '2M',
                                ),
                            ),
                        ),
                    ),
                    'krcms_form' => array(
                        'locale' => $container->getParameter('locale'),
                        'editor' => 'form',
                        'include_assets' => true,
                        'connector' => array(
                            'roots' => array(
                                'uploads' => array(
                                    'driver' => 'LocalFileSystem',
                                    'path' => $config['upload_dir'],
                                    'upload_allow' => array(
                                        'image/png',
                                        'image/jpg',
                                        'image/jpeg',
                                    ),
                                    'upload_deny' => array(
                                        'all',
                                    ),
                                    'upload_max_size' => '2M',
                                ),
                            ),
                        ),
                    ),
                ),
            );
        }

        foreach ($container->getExtensions() as $name => $extension) {
            switch ($name) {
                case 'ivory_ck_editor':
                    $container->prependExtensionConfig($name, $ivoryCkEditorConfig);
                    break;
                case 'fm_elfinder':
                    $container->prependExtensionConfig($name, $fmElfinderConfig);
                    break;
                case 'cmf_routing':
                    $container->prependExtensionConfig($name, $cmfRoutingBundleConfig);
                    break;
                default:
                    break;
            }
        }
    }
}
