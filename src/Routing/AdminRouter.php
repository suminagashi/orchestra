<?php

namespace Suminagashi\OrchestraBundle\Routing;

use Suminagashi\OrchestraBundle\Exception\ResourceClassNotFoundException;
use Suminagashi\OrchestraBundle\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use Suminagashi\OrchestraBundle\Metadata\Resource\Factory\ResourceNameCollectionFactoryInterface;
use Suminagashi\OrchestraBundle\Metadata\Resource\ResourceMetadata;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class AdminRouter extends Loader
{
    /** @var bool $isLoaded */
    private $isLoaded = false;
    /** @var ResourceNameCollectionFactoryInterface */
    private $resourceNameCollectionFactory;
    /** @var ResourceMetadataFactoryInterface */
    private $resourceMetadataFactory;

    /**
     * AdminRouter constructor.
     * @param ResourceNameCollectionFactoryInterface $resourceNameCollectionFactory
     * @param ResourceMetadataFactoryInterface $resourceMetadataFactory
     */
    public function __construct(
        ResourceNameCollectionFactoryInterface $resourceNameCollectionFactory,
        ResourceMetadataFactoryInterface $resourceMetadataFactory
    ) {
        $this->resourceNameCollectionFactory = $resourceNameCollectionFactory;
        $this->resourceMetadataFactory = $resourceMetadataFactory;
    }

    /**
     * @param mixed $resource
     * @param string|null $type
     * @return RouteCollection
     * @throws \ReflectionException
     * @throws ResourceClassNotFoundException
     */
    public function load($resource, string $type = null): RouteCollection
    {
        if (true === $this->isLoaded) {
            throw new \RuntimeException('Do not add the "orchestra" loader twice');
        }

        $collection = new RouteCollection();

        $collection->add('admin_dashboard', new Route('', [
            '_controller' => 'suminagashi_orchestra.controller.dashboard',
        ], [], [], null, [], [Request::METHOD_GET]));

        /** @var ResourceMetadata $item */
        foreach ($this->resourceNameCollectionFactory->create() as $resourceName) {
            $resourceCollection = new RouteCollection();
            $resourceMetadata = $this->resourceMetadataFactory->create($resourceName);
            $resourceCollection->add('_path', new Route('', [
                '_controller' => 'suminagashi_orchestra.controller.collection',
            ], [], [], null, [], [Request::METHOD_GET]));
            $resourceCollection->add('_create', new Route('/create', [
                '_controller' => 'suminagashi_orchestra.controller.item::create'
            ], [], [], null, [], [Request::METHOD_GET, Request::METHOD_POST]));
            $resourceCollection->add('_show', new Route('/{id}', [
                '_controller' => 'suminagashi_orchestra.controller.item::show'
            ], [], [], null, [], [Request::METHOD_GET]));
            $resourceCollection->add('_edit', new Route('/{id}/edit', [
                '_controller' => 'suminagashi_orchestra.controller.item::edit'
            ], [], [], null, [], [Request::METHOD_GET, Request::METHOD_PUT]));
            $resourceCollection->add('_delete', new Route('/{id}', [
                '_controller' => 'suminagashi_orchestra.controller.item::delete'
            ], [], [], null, [], [Request::METHOD_DELETE]));
            $resourceCollection->addNamePrefix($resourceMetadata->getName());
            $resourceCollection->addPrefix('resources/'.$resourceMetadata->getName());
            $resourceCollection->addDefaults(['_resource_class' => $resourceName]);

            $collection->addCollection($resourceCollection);
        }
        $collection->addNamePrefix('orchestra_');

        $this->isLoaded = true;
        return $collection;
    }

    public function supports($resource, string $type = null)
    {
        return 'orchestra' === $type;
    }
}
