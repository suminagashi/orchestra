<?php

namespace Suminagashi\OrchestraBundle\Routing;

use Suminagashi\OrchestraBundle\Annotation\Resource;
use Suminagashi\OrchestraBundle\Utils\EntityParser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class AdminRouter
{
    /** @var EntityParser */
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
            $resourceCollection = new RouteCollection();
            $resourceCollection->add('_path', new Route('', [], [], [], null, [], [Request::METHOD_GET]));
            $resourceCollection->add('_new', new Route('/create', [], [], [], null, [], [Request::METHOD_GET, Request::METHOD_POST]));
            $resourceCollection->add('_show', new Route('/{id}/show', [], [], [], null, [], [Request::METHOD_GET]));
            $resourceCollection->add('_edit', new Route('/{id}/edit', [], [], [], null, [], [Request::METHOD_GET, Request::METHOD_PUT]));
            $resourceCollection->add('_delete', new Route('/{id}/edit', [], [], [], null, [], [Request::METHOD_DELETE]));
            $resourceCollection->addNamePrefix($item->getName());
            $resourceCollection->addPrefix($item->getName());

            $collection->addCollection($resourceCollection);
        }
        $collection->addNamePrefix('orchestra_');
        $collection->addPrefix('resources');

        return $collection;
    }
}