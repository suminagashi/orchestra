<?php

declare(strict_types=1);

namespace Suminagashi\OrchestraBundle\Action;

use Suminagashi\OrchestraBundle\Action\AbstractAction;

use Symfony\Component\HttpFoundation\Response;

final class GetAction extends AbstractAction
{
    public function __invoke()
    {
      return new Response('get');
    }
}
