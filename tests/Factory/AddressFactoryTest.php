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
use T3G\DatahubApiLibrary\Factory\AddressFactory;

class AddressFactoryTest extends TestCase
{
    #[DataProvider('factoryDataProvider')]
    public function testFactory(array $data): void
    {
        $entity = AddressFactory::fromArray($data);
        self::assertEquals($data['uuid'], $entity->getUuid());
        self::assertEquals($data['title'], $entity->getTitle());
        self::assertEquals($data['firstName'], $entity->getFirstName());
        self::assertEquals($data['lastName'], $entity->getLastName());
        self::assertEquals($data['additionalAddressLine1'], $entity->getAdditionalAddressLine1());
        self::assertEquals($data['additionalAddressLine2'], $entity->getAdditionalAddressLine2());
        self::assertEquals($data['street'], $entity->getStreet());
        self::assertEquals($data['city'], $entity->getCity());
        self::assertEquals($data['country']['label'], $entity->getCountryLabel());
        self::assertEquals($data['zip'], $entity->getZip());
        self::assertEquals($data['type'], $entity->getType());
        self::assertEquals($data['latitude'], $entity->getLatitude());
        self::assertEquals($data['longitude'], $entity->getLongitude());
        self::assertEquals($data['checksum'], $entity->getChecksum());
    }

    public static function factoryDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'title' => 'test address',
                    'firstName' => 'Max',
                    'lastName' => 'Mustermann',
                    'additionalAddressLine1' => 'Musterabteilung',
                    'additionalAddressLine2' => 'Sondermuster',
                    'street' => 'Teststreet 1234',
                    'city' => 'Dorf und so',
                    'country' => [
                        'iso' => 'RU',
                        'iso3' => 'RUS',
                        'label' => 'Russia',
                    ],
                    'zip' => '1234 QZ',
                    'type' => 16,
                    'latitude' => 12.94856534257,
                    'longitude' => 8.765486753485,
                    'checksum' => '30489455e915553ca09f9430fb95d6ab055c64326fd9ec17d7a4655f2a4d4fe5',
                ],
            ],
        ];
    }
}
