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

        self::assertSame($data['uuid'], $entity->getUuid());
        self::assertSame($data['type'], $entity->getType());
        self::assertSame($data['history'], $entity->getHistory());
        self::assertSame($data['status'], $entity->getStatus());
        self::assertSame($data['createdAt'], $entity->getCreatedAt()->format(\DateTimeInterface::ATOM));
        self::assertSame($data['validUntil'], $entity->getValidUntil()->format(\DateTimeInterface::ATOM));
        self::assertSame($data['currentJti'], $entity->getCurrentJti());
        self::assertSame($data['subscriptionUuid'], $entity->getSubscriptionUuid());
        self::assertSame($data['eltsPlanUuid'], $entity->getEltsPlanUuid());
        self::assertSame($data['eltsRuntimeUuid'], $entity->getEltsRuntimeUuid());
        self::assertSame($data['eltsVersion'], $entity->getEltsVersion());
        self::assertSame($data['usedFor'] ?? null, $entity->getUsedFor());
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
                    'subscriptionUuid' => null,
                    'eltsPlanUuid' => null,
                    'eltsRuntimeUuid' => null,
                    'eltsVersion' => null,
                    'usedFor' => 'example.com, www.example.com',
                ],
            ],
            'granted for a subscription' => [
                'data' => [
                    'uuid' => '0d5f5d8e-4f8c-4c0f-9d8e-2a7b6a3c1e01',
                    'type' => LicenseProduct::SUITE,
                    'history' => null,
                    'status' => LicenseStatus::VALID,
                    'createdAt' => '2026-09-21T12:53:29+00:00',
                    'validUntil' => '2027-09-21T12:53:29+00:00',
                    'currentJti' => null,
                    'subscriptionUuid' => '5a1d3c8e-6b2f-4e7a-9c0d-1f2e3a4b5c6d',
                    'eltsPlanUuid' => null,
                    'eltsRuntimeUuid' => null,
                    'eltsVersion' => null,
                ],
            ],
            'granted for an ELTS runtime' => [
                'data' => [
                    'uuid' => '9e8d7c6b-5a4f-4e3d-8c2b-1a0f9e8d7c6b',
                    'type' => LicenseProduct::ELTS,
                    'history' => null,
                    'status' => LicenseStatus::VALID,
                    'createdAt' => '2026-09-21T12:53:29+00:00',
                    'validUntil' => '2029-09-21T23:59:59+00:00',
                    'currentJti' => null,
                    'subscriptionUuid' => null,
                    'eltsPlanUuid' => '3b2a1f0e-9d8c-4b7a-8f6e-5d4c3b2a1f0e',
                    'eltsRuntimeUuid' => '7c6b5a4f-3e2d-4c1b-9a0f-8e7d6c5b4a3f',
                    'eltsVersion' => '13.4',
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
                    'subscriptionUuid' => null,
                    'eltsPlanUuid' => null,
                    'eltsRuntimeUuid' => null,
                    'eltsVersion' => null,
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
                    'subscriptionUuid' => null,
                    'eltsPlanUuid' => null,
                    'eltsRuntimeUuid' => null,
                    'eltsVersion' => null,
                ],
            ],
        ];
    }
}
