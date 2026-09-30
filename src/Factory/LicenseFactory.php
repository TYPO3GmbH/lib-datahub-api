<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\License;

/**
 * @extends AbstractFactory<License>
 */
class LicenseFactory extends AbstractFactory
{
    /**
     * @param array{uuid: string, type: string, status: string, createdAt: string, validUntil: string, history: string|null, currentJti: string|null} $data
     */
    public static function fromArray(array $data): License
    {
        return (new License())
            ->setUuid($data['uuid'])
            ->setType($data['type'])
            ->setStatus($data['status'])
            ->setCreatedAt(new \DateTimeImmutable($data['createdAt']))
            ->setValidUntil(new \DateTimeImmutable($data['validUntil']))
            ->setHistory($data['history'])
            ->setCurrentJti($data['currentJti']);
    }
}
