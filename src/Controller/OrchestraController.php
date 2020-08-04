<?php

namespace Suminagashi\OrchestraBundle\Controller;

use Suminagashi\OrchestraBundle\Utils\EntityParser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class OrchestraController extends AbstractController
{
    /**
     * @return Response
     */
    public function dashboard(): Response
    {
        return $this->render('@Orchestra/dashboard.html.twig');
    }

    /**
     * @param string $resource
     * @return Response
     */
    public function resourceCollection(string $resource, EntityParser $entityParser): Response
    {
        $resourceMetadata = $entityParser->getResourceFromName($resource);
        $reflectionClass = new \ReflectionClass($resourceMetadata->getBaseResource());
        $repository = $this->getDoctrine()->getRepository($resourceMetadata->getBaseResource());
        return $this->render('@Orchestra/resource.html.twig', [
            'resource' => $resource,
            'data' => $repository->findAll(),
            'properties' => $reflectionClass->getProperties()
        ]);
    }
}
