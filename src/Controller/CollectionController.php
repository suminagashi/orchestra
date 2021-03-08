<?php

namespace Suminagashi\OrchestraBundle\Controller;

use Suminagashi\OrchestraBundle\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use Suminagashi\OrchestraBundle\Metadata\Resource\Factory\ResourceNameCollectionFactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class CollectionController extends AbstractController
{
    /** @var ResourceMetadataFactoryInterface */
    private $rmFactory;

    /**
     * CollectionController constructor.
     * @param ResourceMetadataFactoryInterface $rmFactory
     */
    public function __construct(ResourceMetadataFactoryInterface $rmFactory)
    {
        $this->rmFactory = $rmFactory;
    }

    /**
     * @param Request $request
     * @param string $resourceClass
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $rc = $request->attributes->get('_resource_class');
        $resourceMetadata = $this->rmFactory->create($rc);
        $repository = $this->getDoctrine()->getRepository($rc);

        return $this->render('@Orchestra/resources/list.html.twig', [
            'resourceMetadata' => $resourceMetadata,
            'data' => $repository->findAll(),
            'properties' => $resourceMetadata->getReflectionClass()->getProperties()
        ]);
    }
}
