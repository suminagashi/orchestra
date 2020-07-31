<?php

namespace Suminagashi\OrchestraBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

use Suminagashi\OrchestraBundle\Service\EntityParser;

class OrchestraController extends AbstractController
{

    /**
     * @Route("/", name="orchestra_root")
     * @Route(
     *  "/{route}",
     *  name="orchestra_dashboard",
     *  requirements={"route"="^(?!.*api|_wdt|_profiler).+"})
     */
    public function indexAction(Request $request, EntityParser $reader)
    {
        $reader->read();

        return $this->render('@Orchestra/dashboard.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

}
