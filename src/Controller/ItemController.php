<?php

namespace Suminagashi\OrchestraBundle\Controller;

use Suminagashi\OrchestraBundle\Exception\PropertyNotFoundException;
use Suminagashi\OrchestraBundle\Metadata\Property\Factory\PropertyMetadataFactoryInterface;
use Suminagashi\OrchestraBundle\Metadata\Property\Factory\PropertyNameCollectionFactoryInterface;
use Suminagashi\OrchestraBundle\Metadata\Property\PropertyMetadata;
use Suminagashi\OrchestraBundle\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ItemController extends AbstractController
{
    /**
     * @var ResourceMetadataFactoryInterface
     */
    private $rmFactory;

    /**
     * @var PropertyMetadataFactoryInterface
     */
    private $propertyFactory;

    /**
     * CollectionController constructor.
     */
    public function __construct(
        ResourceMetadataFactoryInterface $rmFactory,
        PropertyMetadataFactoryInterface $propertyFactory
    ) {
        $this->rmFactory = $rmFactory;
        $this->propertyFactory = $propertyFactory;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \ReflectionException
     * @throws \Suminagashi\OrchestraBundle\Exception\ResourceClassNotFoundException
     */
    public function show(Request $request): Response
    {
        $rc = $request->attributes->get('_resource_class');
        $resourceMetadata = $this->rmFactory->create($rc);
        $repository = $this->getDoctrine()->getRepository($rc);
        $entity = $repository->find($request->attributes->get('id'));
        $properties = array_map(function (\ReflectionProperty $property) use ($rc) {
            try {
                return $this->propertyFactory->create($rc, $property->getName());
            } catch (PropertyNotFoundException $e) {
                return new PropertyMetadata($property->getName());
            }
        }, $resourceMetadata->getReflectionClass()->getProperties());
        dd($properties);

        dd($this->propertyFactory->create($rc));
        return $this->render('@Orchestra/resources/show.html.twig', [
            'resourceMetadata' => $resourceMetadata,
            'item' => $entity,
            'properties' => $this->propertyFactory->create($rc)
        ]);
    }

    public function create(Request $request)
    {

    }

    public function edit(Request $request)
    {

    }

    public function delete(Request $request)
    {

    }

    private function getEntity(Request $request)
    {
        $rc = $request->attributes->get('_resource_class');
        $resourceMetadata = $this->rmFactory->create($rc);
        $repository = $this->getDoctrine()->getRepository($rc);

        return $repository->find($request->attributes->get('id'));
    }
}
