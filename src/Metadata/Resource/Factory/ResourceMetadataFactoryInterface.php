<?php

namespace Suminagashi\OrchestraBundle\Metadata\Resource\Factory;

use Suminagashi\OrchestraBundle\Exception\ResourceClassNotFoundException;
use Suminagashi\OrchestraBundle\Metadata\Resource\ResourceMetadata;

/**
 * Creates a resource metadata value object.
 */
interface ResourceMetadataFactoryInterface
{
    /**
     * Creates a resource metadata.
     *
     * @throws ResourceClassNotFoundException
     */
    public function create(string $resourceClass): ResourceMetadata;
}
