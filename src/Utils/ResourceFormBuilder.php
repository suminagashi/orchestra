<?php

namespace Suminagashi\OrchestraBundle\Utils;

use Suminagashi\OrchestraBundle\Metadata\Property\PropertyMetadata;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

class ResourceFormBuilder
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * ResourceFormBuilder constructor.
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    /**
     * @param $entity
     * @param \Generator $propertiesMetadata
     * @return FormInterface
     */
    public function generateForm($entity, \Generator $propertiesMetadata): FormInterface
    {
        $builder = $this->formFactory->createBuilder(FormType::class, $entity);
        /** @var PropertyMetadata $propertyMetadata */
        foreach ($propertiesMetadata as $propertyMetadata) {
            if ($propertyMetadata->isDisplay()) {
                dump($propertyMetadata);
                $builder->add($propertyMetadata->getBaseProperty(), self::getPropertyFormType($propertyMetadata), [
                    'label' => $propertyMetadata->getLabel()
                ]);
            }
        }
        $builder->add('create', SubmitType::class, ['label' => 'Create']);

        return $builder->getForm();
    }

    /**
     * @param PropertyMetadata $propertyMetadata
     * @return string|null
     */
    private static function getPropertyFormType(PropertyMetadata $propertyMetadata): ?string
    {
        switch ($propertyMetadata->getType()) {
            case 'float':
                return NumberType::class;
            case 'integer':
                return IntegerType::class;
            case 'text':
                return TextareaType::class;
            default:
                return TextType::class;
        }
    }
}