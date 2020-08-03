<?php

namespace Suminagashi\OrchestraBundle\Utils;

/**
 * Load entities & call Annotation & Property parser
 */
class GetEntityMeta
{
    /**
     * @param $class
     * @return array
     */
    public function getMeta($class): array
    {
      $classname = explode('\\',$class->getName())[2];
      return [
        'name' => $classname,
        'fullname' => $class->getName(),
      ];
    }
}
