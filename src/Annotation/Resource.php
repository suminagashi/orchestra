<?php

namespace Suminagashi\OrchestraBundle\Annotation;

/**
 * @Annotation
 * @Target("CLASS")
 */
class Resource
{
    CONST ACTIONS = [
        "create",
        "read",
        "edit",
        "delete"
    ];

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var array
     */
    public $actions = self::ACTIONS;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getActions()
    {
        return $this->actions;
    }
}
