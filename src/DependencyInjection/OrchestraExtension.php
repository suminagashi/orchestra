<?php

declare(strict_types=1);

namespace Suminagashi\OrchestraBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

final class OrchestraExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $this->addAnnotatedClassesToCompile([
          'Suminagashi\\OrchestraBundle\\Controller\\DefaultController',
        ]);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');
    }
}
