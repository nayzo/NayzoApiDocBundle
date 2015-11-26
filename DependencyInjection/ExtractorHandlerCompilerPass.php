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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class ExtractorHandlerCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $handlers = array();
        foreach ($container->findTaggedServiceIds('nayzo_api_doc.extractor.handler') as $id => $attributes) {
            $handlers[] = new Reference($id);
        }

        $container
            ->getDefinition('nayzo_api_doc.extractor.api_doc_extractor')
            ->replaceArgument(5, $handlers);
    }
}
