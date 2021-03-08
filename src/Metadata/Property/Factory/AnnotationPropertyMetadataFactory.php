<?php

namespace Suminagashi\OrchestraBundle\Metadata\Property\Factory;

use Doctrine\Common\Annotations\Reader;
use Suminagashi\OrchestraBundle\Annotation\Field;
use Suminagashi\OrchestraBundle\Exception\PropertyNotFoundException;
use Suminagashi\OrchestraBundle\Metadata\Property\PropertyMetadata;
use Suminagashi\OrchestraBundle\Utils\Reflection;

class AnnotationPropertyMetadataFactory implements PropertyMetadataFactoryInterface
{
    /** @var Reader $reader */
    private $reader;
    /** @var PropertyMetadataFactoryInterface|null $decorated */
    private $decorated;

    public function __construct(Reader $reader, PropertyMetadataFactoryInterface $decorated = null)
    {
        $this->reader = $reader;
        $this->decorated = $decorated;
    }

    /**
     * {@inheritdoc}
     */
    public function create(string $resourceClass, string $property, array $options = []): PropertyMetadata
    {
        $parentPropertyMetadata = null;
        if ($this->decorated) {
            try {
                $parentPropertyMetadata = $this->decorated->create($resourceClass, $property, $options);
            } catch (PropertyNotFoundException $propertyNotFoundException) {
                // Ignore not found exception from decorated factories
            }
        }

        try {
            $reflectionClass = new \ReflectionClass($resourceClass);
        } catch (\ReflectionException $reflectionException) {
            return $this->handleNotFound($parentPropertyMetadata, $resourceClass, $property);
        }

        if ($reflectionClass->hasProperty($property)) {
            $annotation = $this->reader->getPropertyAnnotation($reflectionClass->getProperty($property), Field::class);

            if ($annotation instanceof Field) {
                return $this->createMetadata($annotation, $property, $parentPropertyMetadata);
            }
        }

        foreach (array_merge(Reflection::ACCESSOR_PREFIXES, Reflection::MUTATOR_PREFIXES) as $prefix) {
            $methodName = $prefix.ucfirst($property);
            if (!$reflectionClass->hasMethod($methodName)) {
                continue;
            }

            $reflectionMethod = $reflectionClass->getMethod($methodName);
            if (!$reflectionMethod->isPublic()) {
                continue;
            }

            $annotation = $this->reader->getMethodAnnotation($reflectionMethod, Field::class);

            if ($annotation instanceof Field) {
                return $this->createMetadata($annotation, $property, $parentPropertyMetadata);
            }
        }

        return $this->handleNotFound($parentPropertyMetadata, $resourceClass, $property);
    }

    private function createMetadata(Field $annotation, string $name, PropertyMetadata $parentPropertyMetadata = null): PropertyMetadata
    {
        if (null === $parentPropertyMetadata) {
            return new PropertyMetadata($name);
        }
    }

    /**
     * @param PropertyMetadata|null $parentPropertyMetadata
     * @param string $resourceClass
     * @param string $property
     * @return PropertyMetadata
     * @throws PropertyNotFoundException
     */
    private function handleNotFound(?PropertyMetadata $parentPropertyMetadata, string $resourceClass, string $property): PropertyMetadata
    {
        if (null !== $parentPropertyMetadata) {
            return $parentPropertyMetadata;
        }

        throw new PropertyNotFoundException(sprintf('Property "%s" of class "%s" not found.', $property, $resourceClass));
    }
}
