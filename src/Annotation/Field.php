<?php

namespace Suminagashi\OrchestraBundle\Annotation;

/**
 * @Annotation
 * @Target("PROPERTY")
 */
class Field
{
    /**
     *
     * @var string
     */
    public $label;

    /**
     *
     * @var string
     */
    public $validation;

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getValidation()
    {
        return $this->validation;
    }
}
