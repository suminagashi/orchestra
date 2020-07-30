<?php

declare(strict_types=1);

namespace Suminagashi\OrchestraBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class Orchestra extends Bundle
{
  public function build(ContainerBuilder $container)
  {
      parent::build($container);
  }
}

