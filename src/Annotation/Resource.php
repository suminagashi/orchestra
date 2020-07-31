<?php

namespace Suminagashi\OrchestraBundle\Annotation;

use Doctrine\Common\Annotations\Annotation;

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
    public $actions = [];

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
        if(!$this->actions){
            return self::ACTIONS;
        }
        return $this->actions;
    }
}
