<?php

namespace Suminagashi\OrchestraBundle\Utils;

use Doctrine\Common\Annotations\Reader;
use Suminagashi\OrchestraBundle\Annotation\Resource;
use Suminagashi\OrchestraBundle\Metadata\ResourceMetadata;
use Suminagashi\OrchestraBundle\Utils\Helpers\AnnotationTranslator;
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

    public function __construct(
        Reader $reader,
        $resourceClassDirectories
    )
    {
        $this->reader = $reader;
        $this->resourceClassDirectories = $resourceClassDirectories;
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

    public function getResourceFromName(string $name): ResourceMetadata
    {
        /** @var ResourceMetadata $resource */
        foreach ($this->getAllResources() as $resource) {
            if ($resource->getName() === $name) {
                return $resource;
            }
        }
    }
}
