<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Enum\LicenseProduct;
use T3G\DatahubApiLibrary\Enum\LicenseStatus;
use T3G\DatahubApiLibrary\Factory\LicenseFactory;

class LicenseFactoryTest extends TestCase
{
    #[DataProvider('factoryDataProvider')]
    public function testFactory(array $data): void
    {
        $entity = LicenseFactory::fromArray($data);

        self::assertEquals($data['uuid'], $entity->getUuid());
        self::assertEquals($data['type'], $entity->getType());
        self::assertEquals($data['history'] ?? null, $entity->getHistory());
        self::assertEquals($data['status'], $entity->getStatus());
        self::assertEquals($data['createdAt'], $entity->getCreatedAt()->format(\DateTimeInterface::ATOM));
        self::assertEquals($data['validUntil'], $entity->getValidUntil()->format(\DateTimeInterface::ATOM));
        self::assertEquals($data['currentJti'], $entity->getCurrentJti());
    }

    public static function factoryDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'uuid' => '7f495d25-87de-40f4-82df-158a67dec8ec',
                    'type' => LicenseProduct::SUITE,
                    'history' => '2026-09-21 12:53:29 History entry',
                    'status' => LicenseStatus::VALID,
                    'createdAt' => '2026-09-21T12:53:29+00:00',
                    'validUntil' => '2029-09-21T23:59:59+00:00',
                    'currentJti' => 'e67609e7-f9a5-4645-96bf-d32c6c30089d',
                ],
            ],
            'history is null' => [
                'data' => [
                    'uuid' => 'b4a2252e-96cf-4de9-bb16-ab195ad80dd6',
                    'type' => LicenseProduct::ELTS,
                    'history' => null,
                    'status' => LicenseStatus::INVALID,
                    'createdAt' => '2026-09-21T12:53:29+00:00',
                    'validUntil' => '2029-09-21T23:59:59+00:00',
                    'currentJti' => 'b79ed6f2-3f6f-4032-9c01-1bd7855b3709',
                ],
            ],
            'currentJti is null' => [
                'data' => [
                    'uuid' => 'b4a2252e-96cf-4de9-bb16-ab195ad80dd6',
                    'type' => LicenseProduct::ELTS,
                    'history' => '2025-09-22 12:58:09 ELTS license purchased',
                    'status' => LicenseStatus::VALID,
                    'createdAt' => '2026-09-21T12:53:29+00:00',
                    'validUntil' => '2029-09-21T23:59:59+00:00',
                    'currentJti' => null,
                ],
            ],
        ];
    }
}
