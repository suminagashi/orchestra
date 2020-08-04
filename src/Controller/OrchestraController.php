<?php

namespace Suminagashi\OrchestraBundle\Controller;

use ReflectionException;
use Suminagashi\OrchestraBundle\Utils\EntityParser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class OrchestraController extends AbstractController
{
    /**
     * @param EntityParser $entityParser
     * @return Response
     * @throws ReflectionException
     */
    public function dashboard(EntityParser $entityParser): Response
    {
        $entitiesInfos = $entityParser->read();
        $response = array_merge($entitiesInfos,['baseUrl' => 'orchestra']);

        return $this->render('@Orchestra/dashboard.html.twig', [
            'controller_name' => 'DefaultController',
            'info' => json_encode($response, false),
        ]);
    }
}
