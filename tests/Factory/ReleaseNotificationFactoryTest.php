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
use T3G\DatahubApiLibrary\Factory\ReleaseNotificationFactory;

class ReleaseNotificationFactoryTest extends TestCase
{
    #[DataProvider('factoryDataProvider')]
    public function testFactory(array $data): void
    {
        $entity = ReleaseNotificationFactory::fromArray($data);
        self::assertEquals($data['uuid'], $entity->getUuid());
        self::assertEquals($data['name'], $entity->getName());
        self::assertEquals($data['email'], $entity->getEmail());
    }

    public static function factoryDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'uuid' => '8084048d-5ce4-4727-9f4e-764ff07fa8a0',
                    'name' => 'Baz',
                    'email' => 'baz@bencer.dev',
                    'accepted' => true,
                    'inherited' => true,
                ],
            ],
        ];
    }
}
