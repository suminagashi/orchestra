<?php

namespace Suminagashi\OrchestraBundle\Twig;

use Suminagashi\OrchestraBundle\Utils\EntityParser;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class MenuExtension extends AbstractExtension
{
    /**
     * @var EntityParser
     */
    private $entityParser;

    /**
     * MenuExtension constructor.
     * @param EntityParser $entityParser
     */
    public function __construct(EntityParser $entityParser)
    {
        $this->entityParser = $entityParser;
    }

    /**
     * @return array|TwigFilter[]|TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('admin_resources', [$this, 'getAdminResources']),
        ];
    }

    public function getAdminResources(): \Generator
    {
        return $this->entityParser->getAllResources();
    }
}