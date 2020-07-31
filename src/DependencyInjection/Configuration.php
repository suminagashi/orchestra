<?php

declare(strict_types=1);

namespace Suminagashi\OrchestraBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('orchestra');
        $treeBuilder->getRootNode()->end();

        return $treeBuilder;
    }
}
