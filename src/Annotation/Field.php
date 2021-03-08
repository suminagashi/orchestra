<?php

namespace Suminagashi\OrchestraBundle\Annotation;

/**
 * @Annotation
 * @Target("PROPERTY")
 * @Attributes(
 *     @Attribute("label", type="string"),
 *     @Attribute("display", type="boolean"),
 * )
 */
class Field
{
    /**
     * @var string
     */
    public $label;

    /**
     * @var boolean
     */
    public $display = true;

    /**
     * @var string
     */
    public $validation;
}
