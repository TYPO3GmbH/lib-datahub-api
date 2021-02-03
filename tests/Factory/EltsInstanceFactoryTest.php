<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Factory\EltsInstanceFactory;

class EltsInstanceFactoryTest extends TestCase
{
    /**
     * @dataProvider factoryDataProvider
     * @param array $data
     */
    public function testFactory(array $data): void
    {
        $entity = EltsInstanceFactory::fromArray($data);
        self::assertEquals($data['uuid'], $entity->getUuid());
        self::assertEquals($data['name'], $entity->getName());
        self::assertCount(1, $entity->getTechnicalContacts());
        self::assertCount(1, $entity->getSimpleTechnicalContacts());
    }

    public function factoryDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'name' => 'Wololo',
                    'technicalContacts' => [
                        [
                            'username' => 'foo',
                            'firstName' => 'Foo',
                            'lastName' => 'Bar',
                            'email' => 'foo@bar.baz',
                        ],
                    ],
                    'simpleTechnicalContacts' => [
                        [
                            'uuid' => '8084048d-5ce4-4727-9f4e-764ff07fa8a0',
                            'firstName' => 'Baz',
                            'lastName' => 'Bencer',
                            'email' => 'baz@bencer.dev',
                        ],
                    ],
                ],
            ],
        ];
    }
}
