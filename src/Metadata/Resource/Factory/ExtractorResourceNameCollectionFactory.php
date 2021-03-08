<?php

namespace Suminagashi\OrchestraBundle\Metadata\Resource\Factory;

use InvalidArgumentException;
use Suminagashi\OrchestraBundle\Metadata\Extractor\ExtractorInterface;
use Suminagashi\OrchestraBundle\Metadata\Resource\ResourceNameCollection;

/**
 * Creates a resource name collection from {@see AdminResource} configuration files.
 */
final class ExtractorResourceNameCollectionFactory implements ResourceNameCollectionFactoryInterface
{
    private $extractor;
    private $decorated;

    public function __construct(ExtractorInterface $extractor, ResourceNameCollectionFactoryInterface $decorated = null)
    {
        $this->extractor = $extractor;
        $this->decorated = $decorated;
    }

    /**
     * {@inheritdoc}
     *
     * @throws InvalidArgumentException
     */
    public function create(): ResourceNameCollection
    {
        $classes = [];
        if ($this->decorated) {
            foreach ($this->decorated->create() as $resourceClass) {
                $classes[$resourceClass] = true;
            }
        }

        foreach ($this->extractor->getResources() as $resourceClass => $resource) {
            $classes[$resourceClass] = true;
        }

        return new ResourceNameCollection(array_keys($classes));
    }
}
