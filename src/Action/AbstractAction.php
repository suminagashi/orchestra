<?php

declare(strict_types=1);

namespace Suminagashi\OrchestraBundle\Action;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\RequestStack;

class AbstractAction
{
    protected $requestStack;

    public function __construct(RequestStack $requestStack)
    {
      $this->requestStack = $requestStack;
    }

    public function getClass(): string
    {
      return $this
              ->requestStack
              ->getCurrentRequest()
              ->attributes
              ->get('_route_params')
              ['resource'];
    }

    public function getIdentifier(): string
    {
      return $this
              ->requestStack
              ->getCurrentRequest()
              ->attributes
              ->get('_route_params')
              ['id'];
    }

    public function getPage(): int
    {
      return (int) $this
              ->requestStack
              ->getCurrentRequest()
              ->query
              ->get('page');
    }
}
