<?php

namespace Suminagashi\OrchestraBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

use Suminagashi\OrchestraBundle\Service\EntityParser;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class OrchestraController extends AbstractController
{
    /**
     * @Route("/", name="orchestra_root")
     * @param Request $request
     * @param EntityParser $reader
     * @return Response
     */
    public function indexAction(Request $request, EntityParser $reader): Response
    {
        $entitiesInfos = $reader->read();
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        return $this->render('@Orchestra/dashboard.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

}
