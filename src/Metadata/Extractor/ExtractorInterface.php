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

namespace Suminagashi\OrchestraBundle\Metadata\Extractor;

/**
 * Extracts an array of metadata from a file or a list of files.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
interface ExtractorInterface
{
    /**
     * Parses all metadata files and convert them in an array.
     */
    public function getResources(): array;
}
