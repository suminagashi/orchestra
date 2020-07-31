<?php

namespace Suminagashi\OrchestraBundle\Service;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;

/**
 * Parse annotation of a class
 */
class AnnotationParser
{

    CONST RESOURCE_NAMESPACE = 'Suminagashi\OrchestraBundle\Annotation\Resource';
    CONST FIELD_NAMESPACE = 'Suminagashi\OrchestraBundle\Annotation\Field';

    public function __construct()
    {
      $this->annotationReader = new AnnotationReader;
      $this->listExtractors = [new ReflectionExtractor];
      $this->propertyInfo = new PropertyInfoExtractor(
          $this->listExtractors,
      );
    }

    public function readAnnotationFromClass($class)
    {
          $resourceAnnotation = $this->annotationReader->getClassAnnotation(
            new \ReflectionClass($class),
            self::RESOURCE_NAMESPACE
          );

          if(!$resourceAnnotation){
              return false;
          }

          $fieldsAnnotations = [];

          $properties = $this->propertyInfo->getProperties($class);

          foreach($properties as $property)
          {
              $fieldsAnnotations[$property] = $this->annotationReader->getPropertyAnnotation(
                new \ReflectionProperty($class, $property),
                self::FIELD_NAMESPACE
              );
          }

          return [
              'resource' => $resourceAnnotation,
              'fields' => $fieldsAnnotations,
          ];
    }
}
