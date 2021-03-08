<?php

namespace Suminagashi\OrchestraBundle\Metadata\Resource\Factory;

use Suminagashi\OrchestraBundle\Metadata\Resource\ResourceNameCollection;

/**
 * Creates a resource name collection value object.
 */
interface ResourceNameCollectionFactoryInterface
{
    /**
     * Creates the resource name collection.
     */
    public function create(): ResourceNameCollection;
}
