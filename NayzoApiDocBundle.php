<?php

namespace Nayzo\ApiDocBundle;

use Nayzo\ApiDocBundle\DependencyInjection\AnnotationsProviderCompilerPass;
use Nayzo\ApiDocBundle\DependencyInjection\SwaggerConfigCompilerPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Nayzo\ApiDocBundle\DependencyInjection\LoadExtractorParsersPass;
use Nayzo\ApiDocBundle\DependencyInjection\RegisterExtractorParsersPass;
use Nayzo\ApiDocBundle\DependencyInjection\ExtractorHandlerCompilerPass;

class NayzoApiDocBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new LoadExtractorParsersPass());
        $container->addCompilerPass(new RegisterExtractorParsersPass());
        $container->addCompilerPass(new ExtractorHandlerCompilerPass());
        $container->addCompilerPass(new AnnotationsProviderCompilerPass());
        $container->addCompilerPass(new SwaggerConfigCompilerPass());
    }
}
