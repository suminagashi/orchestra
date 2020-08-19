<?php

namespace Suminagashi\OrchestraBundle\Annotation;

use Doctrine\Common\Annotations\Annotation\Attribute;
use Doctrine\Common\Annotations\Annotation\Attributes;
use Doctrine\Common\Annotations\Annotation\Enum;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * @Annotation
 * @Target("CLASS")
 * @Attributes(
 *     @Attribute("label", type="string"),
 *     @Attribute("actions", type="array"),
 *     @Attribute("path", type="string")
 * )
 */
class Resource
{
    public const AVAILABLE_ACTIONS = [
        "create",
        "read",
        "edit",
        "delete"
    ];

    /**
     * @var string
     */
    public $label;

    /**
     * @var array
     * @Enum(Suminagashi\OrchestraBundle\Annotation\Resource::AVAILABLE_ACTIONS)
     */
    public $actions = self::AVAILABLE_ACTIONS;

    /**
     * @var string
     */
    public $path;
}
