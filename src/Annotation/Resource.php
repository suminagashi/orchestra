<?php

namespace Suminagashi\OrchestraBundle\Annotation;

/**
 * @Annotation
 * @Target("CLASS")
 * @Attributes(
 *     @Attribute("label", type="string"),
 *     @Attribute("actions", type="array")
 * )
 */
class Resource
{
    private const ACTIONS = [
        "create",
        "read",
        "edit",
        "delete"
    ];

    /** @var string */
    private $name;
    /** @var array */
    private $actions = self::ACTIONS;
    /** @var string */
    private $path;

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Resource
     */
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return array
     */
    public function getActions(): ?array
    {
        return $this->actions;
    }

    /**
     * @param array|null $actions
     * @return Resource
     */
    public function setActions(?array $actions): self
    {
        $this->actions = $actions;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param string|null $path
     * @return Resource
     */
    public function setPath(?string $path): self
    {
        $this->path = $path;
        return $this;
    }
}
