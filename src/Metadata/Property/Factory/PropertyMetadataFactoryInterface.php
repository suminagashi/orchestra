<?php

namespace Suminagashi\OrchestraBundle\Metadata\Property\Factory;

use Suminagashi\OrchestraBundle\Metadata\Property\PropertyMetadata;

interface PropertyMetadataFactoryInterface
{
    /**
     * Creates a property metadata.
     *
     * @return PropertyMetadata
     */
    public function create(string $resourceClass, string $property, array $options = []): PropertyMetadata;
}
