<?php

namespace Suminagashi\OrchestraBundle\Metadata\Resource\Factory;

use Suminagashi\OrchestraBundle\Exception\ResourceClassNotFoundException;
use Suminagashi\OrchestraBundle\Metadata\Extractor\ExtractorInterface;
use Suminagashi\OrchestraBundle\Metadata\Resource\ResourceMetadata;

/**
 * Creates resource's metadata using an extractor.
 */
final class ExtractorResourceMetadataFactory implements ResourceMetadataFactoryInterface
{
    private $extractor;
    private $decorated;
    private $defaults;

    public function __construct(ExtractorInterface $extractor, ResourceMetadataFactoryInterface $decorated = null, array $defaults = [])
    {
        $this->extractor = $extractor;
        $this->decorated = $decorated;
        $this->defaults = $defaults + ['attributes' => []];
    }

    /**
     * {@inheritdoc}
     */
    public function create(string $resourceClass): ResourceMetadata
    {
        $parentResourceMetadata = null;
        if ($this->decorated) {
            try {
                $parentResourceMetadata = $this->decorated->create($resourceClass);
            } catch (ResourceClassNotFoundException $resourceNotFoundException) {
                // Ignore not found exception from decorated factories
            }
        }

        if (!(class_exists($resourceClass) || interface_exists($resourceClass)) || !$resource = $this->extractor->getResources()[$resourceClass] ?? false) {
            return $this->handleNotFound($parentResourceMetadata, $resourceClass);
        }

        $resource['description'] = $resource['description'] ?? $this->defaults['description'] ?? null;
        $resource['iri'] = $resource['iri'] ?? $this->defaults['iri'] ?? null;
        $resource['itemOperations'] = $resource['itemOperations'] ?? $this->defaults['item_operations'] ?? null;
        $resource['collectionOperations'] = $resource['collectionOperations'] ?? $this->defaults['collection_operations'] ?? null;
        $resource['graphql'] = $resource['graphql'] ?? $this->defaults['graphql'] ?? null;
        $resource['attributes'] = (null === $resource['attributes'] && [] === $this->defaults['attributes']) ? null : (array) $resource['attributes'] + $this->defaults['attributes'];

        return $this->update($parentResourceMetadata ?: new ResourceMetadata(), $resource);
    }

    /**
     * Returns the metadata from the decorated factory if available or throws an exception.
     *
     * @throws ResourceClassNotFoundException
     */
    private function handleNotFound(?ResourceMetadata $parentPropertyMetadata, string $resourceClass): ResourceMetadata
    {
        if (null !== $parentPropertyMetadata) {
            return $parentPropertyMetadata;
        }

        throw new ResourceClassNotFoundException(sprintf('Resource "%s" not found.', $resourceClass));
    }

    /**
     * Creates a new instance of metadata if the property is not already set.
     */
    private function update(ResourceMetadata $resourceMetadata, array $metadata): ResourceMetadata
    {
        foreach (['shortName', 'description', 'iri', 'itemOperations', 'collectionOperations', 'subresourceOperations', 'graphql', 'attributes'] as $property) {
            if (null === $metadata[$property] || null !== $resourceMetadata->{'get'.ucfirst($property)}()) {
                continue;
            }

            $resourceMetadata = $resourceMetadata->{'with'.ucfirst($property)}($metadata[$property]);
        }

        return $resourceMetadata;
    }
}
