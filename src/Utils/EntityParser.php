<?php

namespace Suminagashi\OrchestraBundle\Utils;

use Doctrine\Common\Annotations\Reader;
use Suminagashi\OrchestraBundle\Annotation\Resource;
use Suminagashi\OrchestraBundle\Utils\Helpers\AnnotationTranslator;
use Suminagashi\OrchestraBundle\Utils\Helpers\ReflectionClassRecursiveIterator;
use Symfony\Component\Finder\Finder;

/**
 * Load entities & call Annotation & Property parser
 */
class EntityParser
{
    /** @var Reader */
    private $reader;
    /** @var array */
    private $resourceClassDirectories;

    public function __construct(
        Reader $reader,
        $resourceClassDirectories
    )
    {
        $this->reader = $reader;
        $this->resourceClassDirectories = $resourceClassDirectories;
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public function read(): array
    {
        $entities = [];
        /**
         * @var string $className
         * @var \ReflectionClass $reflectionClass
         */
        foreach (ReflectionClassRecursiveIterator::getReflectionClassesFromDirectories($this->resourceClassDirectories) as $className => $reflectionClass) {
            $resourceAnnotation = $this->generateDataFromAnnotation($reflectionClass);
            if ($resourceAnnotation !== null) {
                $entities[$className] = $resourceAnnotation;
            }
        }

        return $entities;

    }

    /**
     * @param \ReflectionClass $reflectionClass
     * @return array[]|null
     */
    private function generateDataFromAnnotation(\ReflectionClass $reflectionClass): ?array
    {
        $resourceAnnotation = $this->reader->getClassAnnotation($reflectionClass, Resource::class);
        if ($resourceAnnotation === null) {
            return null;
        }

        $fields = [];
        foreach ($reflectionClass->getProperties() as $property) {
            foreach ($this->reader->getPropertyAnnotations($property) as $annotation) {
                if ($annotationTranslation = AnnotationTranslator::translate($annotation)) {
                     if(isset($fields[$property->getName()][$annotationTranslation['type']])) {
                       $fields[$property->getName()][$annotationTranslation['type']] += $annotationTranslation['values'];
                     } else {
                       $fields[$property->getName()][$annotationTranslation['type']] = $annotationTranslation['values'];
                     }
                }
            }
        }

        $meta = array_merge([
            'name' => $reflectionClass->getShortName(),
            'fullname' => $reflectionClass->getName(),
        ], (array) $resourceAnnotation);

        return [
            'meta' => $meta,
            'fields' => $fields,
        ];
    }
}
