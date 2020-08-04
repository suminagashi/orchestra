<?php

namespace Suminagashi\OrchestraBundle\Routing;

use Suminagashi\OrchestraBundle\Annotation\Resource;
use Suminagashi\OrchestraBundle\Utils\EntityParser;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class AdminRouter
{
    public const TEMPLATE_ROUTE = 'orchestra_%s_path';
    /**
     * @var EntityParser
     */
    private $entityParser;

    /**
     * MenuExtension constructor.
     * @param EntityParser $entityParser
     */
    public function __construct(EntityParser $entityParser)
    {
        $this->entityParser = $entityParser;
    }

    /**
     * @param mixed $resource
     * @param string|null $type
     * @return RouteCollection
     */
    public function __invoke($resource, string $type = null): RouteCollection
    {
        $collection = new RouteCollection();
        /** @var Resource $item */
        foreach ($this->entityParser->getAllResources() as $item) {
            $collection->add(
                $item->getPath(),
                new Route($item->getName())
            );
        }
        $collection->addPrefix('resources');

        return $collection;
    }
}