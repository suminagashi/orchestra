<?php

namespace Suminagashi\OrchestraBundle\Metadata\Property;

use Suminagashi\OrchestraBundle\Annotation\Field;
use Symfony\Component\PropertyInfo\Type;

class PropertyMetadata
{
    /** @var string */
    private $name;
    /** @var string */
    private $label;
    /** @var Type */
    private $type;
    /** @var boolean */
    private $display;

    /**
     * ResourceMetadata constructor.
     * @param string $name
     * @param string $label
     * @param bool $display
     * @param Type|null $type
     */
    public function __construct(string $name, string $label = null, bool $display = true, Type $type = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->display = $display;
        $this->type = $type;
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
    public function getLabel(): string
    {
        return $this->label ?: $this->getName();
    }

    /**
     * @return Type
     */
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * @return bool
     */
    public function isDisplay(): bool
    {
        return $this->display;
    }
}
