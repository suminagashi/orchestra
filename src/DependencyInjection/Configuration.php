<?php

declare(strict_types=1);

namespace Suminagashi\OrchestraBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('orchestra');
        $rootNode = $treeBuilder->getRootNode();
        $rootNode->end();

        return $treeBuilder;
    }
}
