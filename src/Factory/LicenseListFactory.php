<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\License;
use T3G\DatahubApiLibrary\Entity\LicenseList;

/**
 * @extends AbstractFactory<License>
 */
class LicenseListFactory extends AbstractFactory
{
    public static function fromResponseDataCollection(ResponseInterface $response): LicenseList
    {
        /** @var list<array{uuid: string, type: string, status: string, createdAt: string, validUntil: string, history: string|null, currentJti: string|null}> $entities */
        $entities = self::responseToArray($response)['entities'];

        return new LicenseList(array_map(self::fromArray(...), $entities));
    }

    /**
     * @param array{uuid: string, type: string, status: string, createdAt: string, validUntil: string, history: string|null, currentJti: string|null} $data
     */
    public static function fromArray(array $data): License
    {
        return LicenseFactory::fromArray($data);
    }
}
