<?php

namespace Suminagashi\OrchestraBundle\Metadata\Property\Factory;

use Doctrine\Common\Annotations\Reader;
use Suminagashi\OrchestraBundle\Annotation\Field;
use Suminagashi\OrchestraBundle\Exception\ResourceClassNotFoundException;
use Suminagashi\OrchestraBundle\Metadata\Property\PropertyNameCollection;
use Suminagashi\OrchestraBundle\Utils\Reflection;

final class AnnotationPropertyNameCollectionFactory implements PropertyNameCollectionFactoryInterface
{
    private $reader;
    private $decorated;
    private $propertyMetadataFactory;
    private $reflection;

    public function __construct(
        Reader $reader = null,
        PropertyNameCollectionFactoryInterface $decorated = null,
        PropertyMetadataFactoryInterface $propertyMetadataFactory
    ) {
        $this->reader = $reader;
        $this->decorated = $decorated;
        $this->propertyMetadataFactory = $propertyMetadataFactory;
        $this->reflection = new Reflection();
    }

    /**
     * {@inheritdoc}
     */
    public function create(string $resourceClass, array $options = []): PropertyNameCollection
    {
        $propertyNameCollection = null;

        if ($this->decorated) {
            try {
                $propertyNameCollection = $this->decorated->create($resourceClass, $options);
            } catch (ResourceClassNotFoundException $resourceClassNotFoundException) {
                // Ignore not found exceptions from decorated factory
            }
        }

        try {
            $reflectionClass = new \ReflectionClass($resourceClass);
        } catch (\ReflectionException $reflectionException) {
            if (null !== $propertyNameCollection) {
                return $propertyNameCollection;
            }

            throw new ResourceClassNotFoundException(sprintf('The resource class "%s" does not exist.', $resourceClass));
        }

        $propertyNames = [];

        // Properties
        foreach ($reflectionClass->getProperties() as $reflectionProperty) {
            if (
                null !== $this->reader &&
                null !== $this->reader->getPropertyAnnotation($reflectionProperty, Field::class)
            ) {
                $propertyNames[$reflectionProperty->name] = $reflectionProperty->name;
            }
        }

        // Methods
        foreach ($reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $reflectionMethod) {
            if ($reflectionMethod->isStatic()) {
                continue;
            }

            $propertyName = $this->reflection->getProperty($reflectionMethod->name);
            if (null !== $propertyName && !$reflectionClass->hasProperty($propertyName) && !preg_match('/^[A-Z]{2,}/', $propertyName)) {
                $propertyName = lcfirst($propertyName);
            }

            if (
                null !== $propertyName &&
                (
                (null !== $this->reader && null !== $this->reader->getMethodAnnotation($reflectionMethod, Field::class))
                )
            ) {
                $propertyNames[$propertyName] = $propertyName;
            }
        }

        // add property names from decorated factory
        if (null !== $propertyNameCollection) {
            foreach ($propertyNameCollection as $propertyName) {
                $propertyNames[$propertyName] = $propertyName;
            }
        }

        return new PropertyNameCollection(array_values($propertyNames));
    }
}
