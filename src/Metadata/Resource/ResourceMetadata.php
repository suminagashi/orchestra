<?php


namespace Suminagashi\OrchestraBundle\Metadata\Resource;

/**
 * Class ResourceMetadata
 */
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
     * @param string $baseResource
     * @param string $label
     * @param string $name
     */
    public function __construct(string $baseResource, string $label, string $name)
    {
        $this->baseResource = $baseResource;
        $this->label = $label;
        $this->name = $name;
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

    /**
     * @return \ReflectionClass
     * @throws \ReflectionException
     */
    public function getReflectionClass(): \ReflectionClass
    {
        return new \ReflectionClass($this->getBaseResource());

    }
}
