<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Validation;

use T3G\DatahubApiLibrary\Exception\InvalidUuidException;

trait HandlesUuids
{
    /**
     * @param string $uuid
     *
     * @throws InvalidUuidException
     */
    protected function isValidUuidOrThrow(string $uuid): void
    {
        if (0 === (int) preg_match('/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}$/', $uuid)) {
            throw new InvalidUuidException($uuid . ' is not a valid UUID', 1585830601);
        }
    }
}
