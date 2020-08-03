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
     * @var AnnotationParser
     */
    private $annotationParser;

    public function __construct(
        GetEntityMeta $entityMeta,
        AnnotationParser $annotationParser
    )
    {
        $this->getEntityMeta = $entityMeta;
        $this->annotationParser = $annotationParser;
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public function read(): array
    {
        $finder = new Finder();
        $finder->files()->in(self::ENTITY_DIR);

        $entities = [];

        foreach ($finder as $file) {
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
