<?php

namespace Suminagashi\OrchestraBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Common\Annotations\AnnotationReader;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="orchestra_root")
     * @Route(
     *  "/{route}",
     *  name="orchestra_dashboard",
     *  requirements={"route"="^(?!.*api|_wdt|_profiler).+"})
     */
    public function indexAction(Request $request)
    {
        return $this->render('@Orchestra/dashboard.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

}
