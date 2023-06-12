<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Entity\UserEmail;
use T3G\DatahubApiLibrary\Factory\UserEmailListFactory;

class UserEmailListFactoryTest extends TestCase
{
    /**
     * @dataProvider factoryDataProvider
     *
     * @param array $data
     */
    public function testFactory(array $data): void
    {
        $list = UserEmailListFactory::fromArray($data);
        foreach ($list as $entity) {
            self::assertInstanceOf(UserEmail::class, $entity);
        }
    }

    public static function factoryDataProvider(): array
    {
        return [
            [
                'data' => [
                    'entities' => [
                        [
                            'username' => 'oelie-boelie',
                            'email' => 'oelie@boelie.nl',
                        ],
                        [
                            'username' => 'baz-bencer',
                            'email' => 'baz@benc.er',
                        ],
                    ],
                    'length' => 2,
                    'type' => 'App\\Dto\\EntityList\\UserEmailList',
                ],
            ],
        ];
    }
}
