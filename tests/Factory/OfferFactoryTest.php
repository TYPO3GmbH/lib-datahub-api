<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Factory\OfferFactory;

class OfferFactoryTest extends TestCase
{
    /**
     * @dataProvider factoryDataProvider
     *
     * @param array $data
     */
    public function testFactory(array $data): void
    {
        $entity = OfferFactory::fromArray($data);
        self::assertSame($data['uuid'], $entity->getUuid());
        self::assertSame($data['createdAt'], $entity->getCreatedAt()->format(\DateTimeInterface::ATOM));
        self::assertSame($data['validUntil'], $entity->getValidUntil()->format(\DateTimeInterface::ATOM));
        self::assertSame($data['payload'], $entity->getPayload());
        self::assertSame($data['offerNumber'], $entity->getOfferNumber());
        self::assertSame($data['cartIdentifier'], $entity->getCartIdentifier());
        self::assertSame($data['total'], $entity->getTotal());
    }

    public static function factoryDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'uuid' => 'd3cd2a4e-6565-471a-96b7-75772cd850a2',
                    'createdAt' => (new \DateTimeImmutable('yesterday'))->format(\DateTimeInterface::ATOM),
                    'validUntil' => (new \DateTimeImmutable('+28 days'))->format(\DateTimeInterface::ATOM),
                    'payload' => ['foo' => 'bar'],
                    'offerNumber' => 'TO-1234',
                    'cartIdentifier' => 'df5c125c-d643-4a7b-933b-0cbeb3403ee5',
                    'total' => 4200.00,
                ],
            ],
        ];
    }
}
