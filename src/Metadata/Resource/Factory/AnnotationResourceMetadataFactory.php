<?php

namespace Suminagashi\OrchestraBundle\Metadata\Resource\Factory;

use Suminagashi\OrchestraBundle\Annotation\Resource;
use Suminagashi\OrchestraBundle\Exception\ResourceClassNotFoundException;
use Suminagashi\OrchestraBundle\Metadata\Resource\ResourceMetadata;
use Doctrine\Common\Annotations\Reader;
use Symfony\Component\String\Inflector\EnglishInflector;
use function Symfony\Component\String\u;

/**
 * Creates a resource metadata from {@see AdminResource} annotations.
 */
final class AnnotationResourceMetadataFactory implements ResourceMetadataFactoryInterface
{
    private $reader;
    private $decorated;

    public function __construct(Reader $reader, ResourceMetadataFactoryInterface $decorated = null)
    {
        $this->reader = $reader;
        $this->decorated = $decorated;
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

        try {
            $reflectionClass = new \ReflectionClass($resourceClass);
        } catch (\ReflectionException $reflectionException) {
            return $this->handleNotFound($parentResourceMetadata, $resourceClass);
        }

        $resourceAnnotation = $this->reader->getClassAnnotation($reflectionClass, Resource::class);
        if (!$resourceAnnotation instanceof Resource) {
            return $this->handleNotFound($parentResourceMetadata, $resourceClass);
        }

        return $this->createMetadata($resourceAnnotation, $reflectionClass, $parentResourceMetadata);
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

    private function createMetadata(Resource $annotation, \ReflectionClass $reflectionClass, ResourceMetadata $parentResourceMetadata = null): ResourceMetadata
    {
        $inflector = new EnglishInflector();
        $shortName = $inflector->pluralize($reflectionClass->getShortName())[0];

        if (!$parentResourceMetadata) {
            return new ResourceMetadata(
                $reflectionClass->getName(),
                $annotation->label ?: $shortName,
                u($annotation->name ?: $shortName)->lower()->toString()
            );
        }

        $resourceMetadata = $parentResourceMetadata;
        foreach (['shortName', 'description', 'iri', 'itemOperations', 'collectionOperations', 'subresourceOperations', 'graphql', 'attributes'] as $property) {
            $resourceMetadata = $this->createWith($resourceMetadata, $property, $annotation->{$property});
        }

        return $resourceMetadata;
    }

    /**
     * Creates a new instance of metadata if the property is not already set.
     */
    private function createWith(ResourceMetadata $resourceMetadata, string $property, $value): ResourceMetadata
    {
        $upperProperty = ucfirst($property);
        $getter = "get$upperProperty";

        if (null !== $resourceMetadata->{$getter}()) {
            return $resourceMetadata;
        }

        $wither = "with$upperProperty";

        return $resourceMetadata->{$wither}($value);
    }
}
