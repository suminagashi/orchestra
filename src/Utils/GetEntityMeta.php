<?php

namespace Suminagashi\OrchestraBundle\Utils;

/**
 * Load entities & call Annotation & Property parser
 */
class GetEntityMeta
{
    public function getMeta($class)
    {
      $classname = explode('\\',$class->getName())[2];
      return [
        'name' => $classname,
        'fullname' => $class->getName(),
      ];
    }
}
