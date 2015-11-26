<?php

/*
 * This file is part of the NayzoApiDocBundle.
 *
 * (c) Nayzo <alakhefifi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nayzo\ApiDocBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\Definition\Processor;

class NayzoApiDocExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);

        $container->setParameter('nayzo_api_doc.motd.template', $config['motd']['template']);
        $container->setParameter('nayzo_api_doc.exclude_sections', $config['exclude_sections']);
        $container->setParameter('nayzo_api_doc.default_sections_opened', $config['default_sections_opened']);
        $container->setParameter('nayzo_api_doc.schema_path', $config['schema_path']);
        $container->setParameter('nayzo_api_doc.api_name', $config['name']);
        $container->setParameter('nayzo_api_doc.sandbox.enabled',  $config['sandbox']['enabled']);
        $container->setParameter('nayzo_api_doc.sandbox.endpoint', $config['sandbox']['endpoint']);
        $container->setParameter('nayzo_api_doc.sandbox.accept_type', $config['sandbox']['accept_type']);
        $container->setParameter('nayzo_api_doc.sandbox.body_format.formats', $config['sandbox']['body_format']['formats']);
        $container->setParameter('nayzo_api_doc.sandbox.body_format.default_format', $config['sandbox']['body_format']['default_format']);
        $container->setParameter('nayzo_api_doc.sandbox.request_format.method', $config['sandbox']['request_format']['method']);
        $container->setParameter('nayzo_api_doc.sandbox.request_format.default_format', $config['sandbox']['request_format']['default_format']);
        $container->setParameter('nayzo_api_doc.sandbox.request_format.formats', $config['sandbox']['request_format']['formats']);
        $container->setParameter('nayzo_api_doc.sandbox.entity_to_choice', $config['sandbox']['entity_to_choice']);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('formatters.xml');
        $loader->load('services.xml');

        if ($config['request_listener']['enabled']) {
            $container->setParameter('nayzo_api_doc.request_listener.parameter', $config['request_listener']['parameter']);
            $loader->load('request_listener.xml');
        }

        if (isset($config['sandbox']['authentication'])) {
            $container->setParameter('nayzo_api_doc.sandbox.authentication', $config['sandbox']['authentication']);
        }

        // backwards compatibility for Symfony2.1 https://github.com/nayzo/NayzoApiDocBundle/issues/231
        if (!interface_exists('\Symfony\Component\Validator\MetadataFactoryInterface')) {
            $container->setParameter('nayzo_api_doc.parser.validation_parser.class', 'Nayzo\ApiDocBundle\Parser\ValidationParserLegacy');
        }

        $container->setParameter('nayzo_api_doc.swagger.base_path', $config['swagger']['api_base_path']);
        $container->setParameter('nayzo_api_doc.swagger.swagger_version', $config['swagger']['swagger_version']);
        $container->setParameter('nayzo_api_doc.swagger.api_version', $config['swagger']['api_version']);
        $container->setParameter('nayzo_api_doc.swagger.info', $config['swagger']['info']);
        $container->setParameter('nayzo_api_doc.swagger.model_naming_strategy', $config['swagger']['model_naming_strategy']);

        if ($config['cache']['enabled'] === true) {
            $arguments = $container->getDefinition('nayzo_api_doc.extractor.api_doc_extractor')->getArguments();
            $caching = new Definition('Nayzo\ApiDocBundle\Extractor\CachingApiDocExtractor');
            $arguments[] = $config['cache']['file'];
            $arguments[] = '%kernel.debug%';
            $caching->setArguments($arguments);
            $container->setDefinition('nayzo_api_doc.extractor.api_doc_extractor', $caching);
        }
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return 'http://nayzo.github.io/schema/dic/nayzo_api_doc';
    }

    /**
     * @return string
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__ . '/../Resources/config/schema';
    }
}
