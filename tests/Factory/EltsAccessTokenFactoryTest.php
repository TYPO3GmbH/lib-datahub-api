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
use T3G\DatahubApiLibrary\Factory\EltsAccessTokenFactory;

class EltsAccessTokenFactoryTest extends TestCase
{
    #[DataProvider('factoryDataProvider')]
    public function testFactory(array $data): void
    {
        $entity = EltsAccessTokenFactory::fromArray($data);

        self::assertEquals($data['uuid'], $entity->getUuid());
        self::assertEquals($data['name'], $entity->getName());
        self::assertEquals($data['description'] ?? null, $entity->getDescription());
        self::assertEquals($data['token'], $entity->getToken());
        self::assertEquals($data['createdAt'], $entity->getCreatedAt()->format(\DateTimeInterface::ATOM));
    }

    public static function factoryDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'name' => 'Token #1',
                    'description' => 'Describe me',
                    'token' => 'ABCDEF',
                    'createdAt' => '2020-02-26T00:00:00+00:00',
                ],
            ],
            'description is null' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'name' => 'Token #1',
                    'description' => null,
                    'token' => 'ABCDEF',
                    'createdAt' => '2020-02-26T00:00:00+00:00',
                ],
            ],
            'missing description' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'name' => 'Token #1',
                    'token' => 'ABCDEF',
                    'createdAt' => '2020-02-26T00:00:00+00:00',
                ],
            ],
        ];
    }
}
