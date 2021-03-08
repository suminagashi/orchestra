<?php

namespace Suminagashi\OrchestraBundle\Twig;

use Generator;
use Suminagashi\OrchestraBundle\Exception\ResourceClassNotFoundException;
use Suminagashi\OrchestraBundle\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use Suminagashi\OrchestraBundle\Metadata\Resource\Factory\ResourceNameCollectionFactoryInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class MenuExtension extends AbstractExtension
{
    /** @var ResourceNameCollectionFactoryInterface */
    private $resourceNameCollectionFactory;
    /** @var ResourceMetadataFactoryInterface */
    private $resourceMetadataFactory;

    /**
     * MenuExtension constructor.
     * @param ResourceNameCollectionFactoryInterface $resourceNameCollectionFactory
     * @param ResourceMetadataFactoryInterface $resourceMetadataFactory
     */
    public function __construct(ResourceNameCollectionFactoryInterface $resourceNameCollectionFactory, ResourceMetadataFactoryInterface $resourceMetadataFactory)
    {
        $this->resourceNameCollectionFactory = $resourceNameCollectionFactory;
        $this->resourceMetadataFactory = $resourceMetadataFactory;
    }

    /**
     * @return array|TwigFilter[]|TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('admin_resources', [$this, 'getAdminResources']),
        ];
    }

    /**
     * @return Generator
     * @throws ResourceClassNotFoundException
     */
    public function getAdminResources(): Generator
    {
        foreach ($this->resourceNameCollectionFactory->create() as $item) {
            yield $this->resourceMetadataFactory->create($item);
        }
    }
}