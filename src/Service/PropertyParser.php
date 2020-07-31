<?php

namespace Suminagashi\OrchestraBundle\Service;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
/**
 * Parse entity properties
 */
class PropertyParser
{
    public function __construct()
    {
      $phpDocExtractor = new PhpDocExtractor();
      $reflectionExtractor = new ReflectionExtractor();

      $accessExtractors = [$reflectionExtractor];
      $typeExtractors = [$phpDocExtractor, $reflectionExtractor];
      $descriptionExtractors = [$phpDocExtractor];

      $this->listExtractors = [new ReflectionExtractor];
      $this->propertyInfo = new PropertyInfoExtractor(
          $this->listExtractors,
          $accessExtractors,
          $typeExtractors,
          $descriptionExtractors,
      );
    }

    public function readPropertiesFromClass($class)
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
