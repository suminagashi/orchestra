<?php


namespace Suminagashi\OrchestraBundle\Factory;


use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\PropertyInfo\DoctrineExtractor;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;

final class PropertyInfoExtractorFactory
{
    /** @var ManagerRegistry */
    private $managerRegistry;

    /**
     * PropertyInfoExtractor constructor.
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    public function createPropertyInfoExtractor(): PropertyInfoExtractor
    {
        // a full list of extractors is shown further below
        $phpDocExtractor = new PhpDocExtractor();
        $reflectionExtractor = new ReflectionExtractor();

        // list of PropertyListExtractorInterface (any iterable)
        $listExtractors = [$reflectionExtractor];
        // list of PropertyTypeExtractorInterface (any iterable)
        $typeExtractors = [$phpDocExtractor, $reflectionExtractor];
        // list of PropertyDescriptionExtractorInterface (any iterable)
        $descriptionExtractors = [$phpDocExtractor];
        // list of PropertyDescriptionExtractorInterface (any iterable)
        $accessExtractors = [$reflectionExtractor];
        // list of PropertyInitializableExtractorInterface (any iterable)
        $propertyInitializableExtractors = [$reflectionExtractor];

        if ($this->managerRegistry->getManager() instanceof EntityManagerInterface) {
            $doctrineExtractor = new DoctrineExtractor($this->managerRegistry->getManager());
            array_unshift($listExtractors, $doctrineExtractor);
            array_unshift($typeExtractors, $doctrineExtractor);
            array_unshift($accessExtractors, $doctrineExtractor);
        }

        return new PropertyInfoExtractor(
            $listExtractors,
            $typeExtractors,
            $descriptionExtractors,
            $accessExtractors,
            $propertyInitializableExtractors
        );
    }
}