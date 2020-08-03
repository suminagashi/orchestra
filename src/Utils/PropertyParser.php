<?php

namespace Suminagashi\OrchestraBundle\Utils;

use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;

/**
 * Parse entity properties
 */
class PropertyParser
{
    /**
     * @var PropertyInfoExtractor
     */
    private $propertyInfo;

    public function __construct()
    {
      $phpDocExtractor = new PhpDocExtractor();
      $reflectionExtractor = new ReflectionExtractor();

      $this->propertyInfo = new PropertyInfoExtractor(
          [new ReflectionExtractor],
          [$reflectionExtractor],
          [$phpDocExtractor, $reflectionExtractor],
          [$phpDocExtractor]
      );
    }

    /**
     * @param $class
     * @return array
     */
    public function readPropertiesFromClass($class): array
    {

      $parsedProperties = [];

      $properties = $this->propertyInfo->getProperties($class);
      foreach ($properties as $property) {
        $type = $this->propertyInfo->getTypes($class,$property);
        $parsedProperties[$property] = $type[0]->getBuiltinType();
      }
      return $parsedProperties;
    }
}
