<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\LicenseToken;

/**
 * @extends AbstractFactory<LicenseToken>
 */
class LicenseTokenFactory extends AbstractFactory
{
    /**
     * @param array{token: string, expiresAt: string} $data
     */
    public static function fromArray(array $data): LicenseToken
    {
        return (new LicenseToken())
            ->setToken($data['token'])
            ->setExpiresAt(new \DateTimeImmutable($data['expiresAt']));
    }
}
