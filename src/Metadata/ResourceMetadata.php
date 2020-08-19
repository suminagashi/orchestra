<?php


namespace Suminagashi\OrchestraBundle\Metadata;

use Suminagashi\OrchestraBundle\Annotation\Resource;
use Symfony\Component\String\Inflector\EnglishInflector;
use function Symfony\Component\String\u;

class ResourceMetadata
{
    /** @var string */
    private $baseResource;
    /** @var string */
    private $label;
    /** @var string */
    private $name;

    /**
     * ResourceMetadata constructor.
     * @param Resource $resourceAnnotation
     * @param \ReflectionClass $reflectionClass
     */
    public function __construct(Resource $resourceAnnotation, \ReflectionClass $reflectionClass)
    {
        $inflector = new EnglishInflector();
        $shortName = $inflector->pluralize($reflectionClass->getShortName())[0];
        $this->name = u($resourceAnnotation->name ?: $shortName)->lower();
        $this->label = $resourceAnnotation->label ?: $shortName;
        $this->baseResource = $reflectionClass->getName();
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getBaseResource(): string
    {
        return $this->baseResource;
    }
}