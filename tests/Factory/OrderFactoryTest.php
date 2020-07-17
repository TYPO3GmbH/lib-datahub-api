<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Factory\OrderFactory;

class OrderFactoryTest extends TestCase
{
    /**
     * @dataProvider factoryDataProvider
     * @param array $data
     */
    public function testFactory(array $data): void
    {
        $entity = OrderFactory::fromArray($data);
        $this->assertEquals($data['uuid'], $entity->getUuid());
        $this->assertEquals($data['orderNumber'], $entity->getOrderNumber());
        $this->assertEquals($data['payload'], $entity->getPayload());
        $this->assertEquals((new \DateTime('2020-01-10T00:00:00+00:00'))->getTimestamp(), $entity->getCreatedAt()->getTimestamp());
    }

    public function factoryDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'orderNumber' => 'D12345',
                    'createdAt' => '2020-01-10T00:00:00+00:00',
                    'payload' => [
                        'items' => [
                            ['foo' => 'bar']
                        ]
                    ]
                ]
            ]
        ];
    }
}
