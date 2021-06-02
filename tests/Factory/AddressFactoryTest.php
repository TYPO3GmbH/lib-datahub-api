<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Factory\AddressFactory;

class AddressFactoryTest extends TestCase
{
    /**
     * @dataProvider factoryDataProvider
     * @param array $data
     */
    public function testFactory(array $data): void
    {
        $entity = AddressFactory::fromArray($data);
        $this->assertEquals($data['uuid'], $entity->getUuid());
        $this->assertEquals($data['title'], $entity->getTitle());
        $this->assertEquals($data['firstName'], $entity->getFirstName());
        $this->assertEquals($data['lastName'], $entity->getLastName());
        $this->assertEquals($data['additionalAddressLine1'], $entity->getAdditionalAddressLine1());
        $this->assertEquals($data['additionalAddressLine2'], $entity->getAdditionalAddressLine2());
        $this->assertEquals($data['street'], $entity->getStreet());
        $this->assertEquals($data['city'], $entity->getCity());
        $this->assertEquals($data['country']['label'], $entity->getCountryLabel());
        $this->assertEquals($data['zip'], $entity->getZip());
        $this->assertEquals($data['type'], $entity->getType());
        $this->assertEquals($data['latitude'], $entity->getLatitude());
        $this->assertEquals($data['longitude'], $entity->getLongitude());
        $this->assertEquals($data['checksum'], $entity->getChecksum());
    }

    public function factoryDataProvider(): array
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
                        'label' => 'Russia'
                    ],
                    'zip' => '1234 QZ',
                    'type' => 16,
                    'latitude' => 12.94856534257,
                    'longitude' => 8.765486753485,
                    'checksum' => '30489455e915553ca09f9430fb95d6ab055c64326fd9ec17d7a4655f2a4d4fe5',
                ]
            ]
        ];
    }
}
