<?php

namespace Suminagashi\OrchestraBundle\Utils;

use Doctrine\Common\Annotations\AnnotationReader;
use Suminagashi\OrchestraBundle\Annotation\Field;
use Suminagashi\OrchestraBundle\Annotation\Resource;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;

/**
 * Parse annotation of a class
 */
class AnnotationParser
{
    public CONST RESOURCE_NAMESPACE = Resource::class;
    public CONST FIELD_NAMESPACE = Field::class;

    /**
     * @var AnnotationTranslator
     */
    private $translator;
    /**
     * @var AnnotationReader
     */
    private $annotationReader;
    /**
     * @var PropertyInfoExtractor
     */
    private $propertyInfo;

    public function __construct(AnnotationTranslator $annotationTranslator, AnnotationReader $annotationReader)
    {
      $this->translator = $annotationTranslator;
      $this->annotationReader = $annotationReader;
      $this->propertyInfo = new PropertyInfoExtractor([new ReflectionExtractor]);
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
