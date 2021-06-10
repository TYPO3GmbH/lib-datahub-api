<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Factory\InvoiceFactory;

class InvoiceFactoryTest extends TestCase
{
    /**
     * @dataProvider factoryDataProvider
     * @param array $data
     */
    public function testFactory(array $data): void
    {
        $entity = InvoiceFactory::fromArray($data);
        $this->assertEquals($data['link'], $entity->getLink());
        $this->assertEquals((new \DateTime('2020-01-10T00:00:00+00:00'))->getTimestamp(), $entity->getDate()->getTimestamp());
        $this->assertEquals($data['uuid'] ?? '', $entity->getUuid());
        $this->assertEquals($data['identifier'] ?? '', $entity->getIdentifier());
        $this->assertEquals($data['title'] ?? '', $entity->getTitle());
        $this->assertEquals($data['number'] ?? '', $entity->getNumber());
    }

    public function factoryDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'identifier' => 'in_1234',
                    'link' => '/account/foo',
                    'title' => 'Test-Invoice',
                    'number' => 'I123456',
                    'date' => '2020-01-10T00:00:00+00:00',
                ]
            ],
            'allRequiredValuesSet' => [
                'data' => [
                    'link' => '/account/foo',
                    'date' => '2020-01-10T00:00:00+00:00',
                ]
            ]
        ];
    }
}
