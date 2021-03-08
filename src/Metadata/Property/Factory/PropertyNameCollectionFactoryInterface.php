<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Suminagashi\OrchestraBundle\Metadata\Property\Factory;

use Suminagashi\OrchestraBundle\Exception\ResourceClassNotFoundException;
use Suminagashi\OrchestraBundle\Metadata\Property\PropertyNameCollection;

/**
 * Creates a property name collection value object.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
interface PropertyNameCollectionFactoryInterface
{
    /**
     * Creates the property name collection for the given class and options.
     *
     * @throws ResourceClassNotFoundException
     */
    public function create(string $resourceClass, array $options = []): PropertyNameCollection;
}
