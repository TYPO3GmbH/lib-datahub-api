<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Factory\EltsPlanFactory;

class EltsPlanFactoryTest extends TestCase
{
    /**
     * @dataProvider factoryDataProvider
     * @param array $data
     */
    public function testFactory(array $data): void
    {
        $entity = EltsPlanFactory::fromArray($data);
        self::assertEquals($data['uuid'], $entity->getUuid());
        self::assertEquals($data['version'], $entity->getVersion());
        self::assertEquals($data['type'], $entity->getType());
        self::assertEquals($data['runtime'], $entity->getRuntime());
        self::assertCount(1, $entity->getInstances());
    }

    public function factoryDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'version' => '8.7',
                    'type' => 'agency',
                    'runtime' => '1-3',
                    'instances' => [
                        [
                            'uuid' => 'add4c176-5fda-4b02-a877-ca3f4d48ca3f',
                            'name' => 'Wololo',
                            'simpleTechnicalContacts' => [],
                            'technicalContacts' => [],
                        ],
                    ],
                ],
            ],
        ];
    }
}
