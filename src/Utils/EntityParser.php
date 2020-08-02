<?php

namespace Suminagashi\OrchestraBundle\Utils;

use Symfony\Component\Finder\Finder;

/**
 * Load entities & call Annotation & Property parser
 */
class EntityParser
{
    public const ENTITY_DIR = '../src/Entity';
    public const ENTITY_NAMESPACE = 'App\\Entity\\';

    /**
     * @var GetEntityMeta
     */
    private $getEntityMeta;
    /**
     * @var Finder
     */
    private $finder;
    /**
     * @var AnnotationParser
     */
    private $annotationParser;

    public function __construct(
        GetEntityMeta $entityMeta,
        Finder $finder,
        AnnotationParser $annotationParser
    )
    {
        $this->getEntityMeta = $entityMeta;
        $this->finder = $finder;
        $this->annotationParser = $annotationParser;
    }

    public function read()
    {

        $this->finder->files()->in(self::ENTITY_DIR);

        $entities = [];

        foreach ($this->finder as $file) {
            $class = self::ENTITY_NAMESPACE . $file->getBasename('.php');
            $annotations = $this->annotationParser->readAnnotationFromClass($class);

            if (!$annotations) {
                continue;
            }

            $meta = $this->getEntityMeta->getMeta(new \ReflectionClass($class));

            $entities[$class] = [
                'meta' => $meta,
                'data' => $annotations,
            ];
        }

        return $entities;

    }
}
