<?php

declare(strict_types=1);

namespace Suminagashi\OrchestraBundle\Action;

use Suminagashi\OrchestraBundle\Action\AbstractAction;

use Symfony\Component\HttpFoundation\Response;

final class PatchAction extends AbstractAction
{
    public function __invoke(string $ressource)
    {
        return new Response('patch');
    }
}
