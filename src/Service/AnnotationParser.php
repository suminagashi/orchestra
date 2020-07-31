<?php

namespace Suminagashi\OrchestraBundle\Service;

use Doctrine\Common\Annotations\AnnotationReader;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;

use Suminagashi\OrchestraBundle\Service\AnnotationTranslator;

/**
 * Parse annotation of a class
 */
class AnnotationParser
{

    CONST RESOURCE_NAMESPACE = 'Suminagashi\OrchestraBundle\Annotation\Resource';
    CONST FIELD_NAMESPACE = 'Suminagashi\OrchestraBundle\Annotation\Field';

    public function __construct()
    {
      $this->translator = new AnnotationTranslator();
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

          //$annotations = $this->annotationReader->getClassAnnotations(new \ReflectionClass($class));

          if(!$resourceAnnotation){
              return false;
          }

          $properties = $this->propertyInfo->getProperties($class);

          foreach($properties as $property)
          {
              $annotations[$property] = $this->annotationReader->getPropertyAnnotations(new \ReflectionProperty($class, $property));

              foreach ($annotations[$property] as $annotation) {
                if($this->translator->translate($annotation)){
                  $parsed[$property][] = $this->translator->translate($annotation);
                }
              }
          }

          return [
              'resource' => $resourceAnnotation,
              'fields' => $parsed,
          ];
    }

}
