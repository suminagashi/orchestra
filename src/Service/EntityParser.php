<?php

namespace Suminagashi\OrchestraBundle\Service;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;


use Suminagashi\OrchestraBundle\Service\AnnotationParser;
use Suminagashi\OrchestraBundle\Service\PropertyParser;
/**
 * Load entities & call Annotation & Property parser
 */
class EntityParser
{

    CONST ENTITY_DIR = '../src/Entity';
    CONST ENTITY_NAMESPACE = 'App\\Entity\\';

    public function __construct()
    {
      $this->finder = new Finder;
      $this->annotationParser = new AnnotationParser;
      $this->propertyParser = new PropertyParser;
    }

    public function read()
    {

      $this->finder->files()->in(self::ENTITY_DIR);

      $entities = [];

      foreach ($this->finder as $file) {

          $class = self::ENTITY_NAMESPACE . $file->getBasename('.php');
          $annotations = $this->annotationParser->readAnnotationFromClass($class);
          $properties = $this->propertyParser->readPropertiesFromClass($class);

          $entities[$class] = [
            'annotations' => $annotations,
            'properties' => $properties,
          ];
      }

      return $entities;

    }
}
