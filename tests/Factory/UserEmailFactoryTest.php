<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Factory\UserEmailFactory;

class UserEmailFactoryTest extends TestCase
{
    /**
     * @dataProvider factoryDataProvider
     *
     * @param array $data
     */
    public function testFactory(array $data): void
    {
        $entity = UserEmailFactory::fromArray($data);
        self::assertEquals($data['username'], $entity->getUsername());
        self::assertEquals($data['email'], $entity->getEmail());
    }

    public static function factoryDataProvider(): array
    {
        return [
            [
                'data' => [
                    'username' => 'oelie-boelie',
                    'email' => 'oelie@boelie.nl',
                ],
            ],
        ];
    }
}
