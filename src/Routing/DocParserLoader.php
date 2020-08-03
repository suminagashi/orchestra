<?php

namespace Suminagashi\OrchestraBundle\Routing;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\RouteCollection;

class DocParserLoader extends Loader
{
    public function load($resource, string $type = null)
    {
        // Need to be implemented
        $collection = new RouteCollection();

        return $collection;
    }

    public function supports($resource, string $type = null)
    {
        return 'orchestra' === $type;
    }
}