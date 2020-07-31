<?php

namespace Suminagashi\OrchestraBundle\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
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
