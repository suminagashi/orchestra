<?php

declare(strict_types=1);

namespace Suminagashi\OrchestraBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        if (method_exists(TreeBuilder::class, 'getRootNode')) {
            $treeBuilder = new TreeBuilder('api_platform');
            $rootNode = $treeBuilder->getRootNode();
        } else {
            $treeBuilder = new TreeBuilder();
            $rootNode = $treeBuilder->root('api_platform');
        }

        $rootNode
            ->children()
                ->arrayNode('resource_class_directories')
                    ->prototype('scalar')->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
