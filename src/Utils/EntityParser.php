<?php

namespace Suminagashi\OrchestraBundle\Utils;

use Doctrine\Common\Annotations\Reader;
use Suminagashi\OrchestraBundle\Annotation\Resource;
use Suminagashi\OrchestraBundle\Metadata\Property\Factory\PropertyMetadataFactoryInterface;
use Suminagashi\OrchestraBundle\Metadata\Resource\ResourceMetadata;
use Suminagashi\OrchestraBundle\Utils\Helpers\ReflectionClassRecursiveIterator;

/**
 * Load entities & call Annotation & Property parser
 */
class EntityParser
{
    /** @var Reader */
    private $reader;
    /** @var array */
    private $resourceClassDirectories;
    /** @var PropertyMetadataFactoryInterface */
    private $propertyMetadataFactory;

    /**
     * EntityParser constructor.
     * @param Reader $reader
     * @param PropertyMetadataFactoryInterface $propertyMetadataFactory
     * @param $resourceClassDirectories
     */
    public function __construct(
        Reader $reader,
        PropertyMetadataFactoryInterface $propertyMetadataFactory,
        $resourceClassDirectories
    )
    {
        $this->reader = $reader;
        $this->resourceClassDirectories = $resourceClassDirectories;
        $this->propertyMetadataFactory = $propertyMetadataFactory;
    }

    /**
     * @return \Generator|null
     */
    public function getAllResources(): ?\Generator
    {
        /**
         * @var string $className
         * @var \ReflectionClass $reflectionClass
         */
        foreach (ReflectionClassRecursiveIterator::getReflectionClassesFromDirectories($this->resourceClassDirectories) as $className => $reflectionClass) {
            /** @var Resource $resourceAnnotation */
            $resourceAnnotation = $this->reader->getClassAnnotation($reflectionClass, Resource::class);
            if ($resourceAnnotation !== null) {
                yield new ResourceMetadata($resourceAnnotation, $reflectionClass);
            }
        }
    }

    /**
     * @param \ReflectionClass $reflectionClass
     * @return \Generator|null
     */
    public function getAllProperties(\ReflectionClass $reflectionClass): ?\Generator
    {
        $properties = $this->propertyMetadataFactory->create($reflectionClass->getName(), 'name');
        dd($this->propertyMetadataFactory);
//        foreach ($properties as $property) {
//            if ($this->propertyInfoExtractor->isWritable($reflectionClass->getName(), $property)) {
//                yield $this->propertyMetadataFactory->create($reflectionClass->getName(), $property);
//            }
//        }
    }

    /**
     * @param string $name
     * @return ResourceMetadata
     */
    public function getResourceFromName(string $name): ResourceMetadata
    {
        /** @var ResourceMetadata $resource */
        foreach ($this->getAllResources() as $resource) {
            if ($resource->getName() === $name) {
                return $resource;
            }
        }
    }

    /**
     * @param string $name
     * @return \Generator
     * @throws \ReflectionException
     */
    public function getPropertiesFromName(string $name): \Generator
    {
        $resourceMetadata = $this->getResourceFromName($name);
        /** @var ResourceMetadata $resource */
        return $this->getAllProperties($resourceMetadata->getReflectionClass());
    }
}
