<?php

declare(strict_types=1);

namespace Suminagashi\OrchestraBundle\DependencyInjection;

use Doctrine\Common\Annotations\Annotation;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\FileLoader;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

final class OrchestraExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $projectDir = $container->getParameter('kernel.project_dir');

        $container->setParameter(
            'suminagashi_orchestra.resource_class_directories',
            $config['resource_class_directories'] ?: [$projectDir.'/src/Entity']
        );

        $loader->load('services.xml');

        $this->registerMetadataConfiguration($loader);

    }

    private function registerMetadataConfiguration(FileLoader $loader)
    {
        $loader->load('metadata/metadata.xml');
        $loader->load('metadata/xml.xml');

        if (class_exists(Annotation::class)) {
            $loader->load('metadata/annotation.xml');
        }
    }
}
