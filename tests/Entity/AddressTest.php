<?php
declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Entity;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Entity\Address;

class AddressTest extends TestCase
{
    /**
     * @dataProvider deutschePostDataProvider
     * @param Address $address
     * @param array $expected
     */
    public function testDeutschePostAddressConversion(Address $address, array $expected): void
    {
        self::assertEquals($expected, $address->toDeutschePostArray());
    }

    public function deutschePostDataProvider(): array
    {
        return [
            'normal address' => [
                'address' => (new Address())
                    ->setFirstName('Oelie')
                    ->setLastName('Boelie')
                    ->setCity('Berlin')
                    ->setCountryIso3('DEU')
                    ->setStreet('Teststreet 123')
                    ->setZip('12345')
                    ->setAdditionalAddressLine1('Test GmbH'),
                'expected' => [
                    'NAME' => 'Oelie Boelie',
                    'ZUSATZ' => 'Test GmbH',
                    'STRASSE' => 'Teststreet',
                    'NUMMER' => '123',
                    'PLZ' => '12345',
                    'STADT' => 'Berlin',
                    'LAND' => 'DEU',
                    'ADRESS_TYP' => 'HOUSE',
                    'REFERENZ' => null,
                ]
            ],
            'address with special characters' => [
                'address' => (new Address())
                    ->setFirstName('Øelie')
                    ->setLastName('Bőelie')
                    ->setCity('Bérlin')
                    ->setCountryIso3('DEU')
                    ->setStreet('Teststraße 123')
                    ->setZip('12345')
                    ->setAdditionalAddressLine1('Tæçt GmbH'),
                'expected' => [
                    'NAME' => 'Oelie Boelie',
                    'ZUSATZ' => 'Taect GmbH',
                    'STRASSE' => 'Teststrasse',
                    'NUMMER' => '123',
                    'PLZ' => '12345',
                    'STADT' => 'Berlin',
                    'LAND' => 'DEU',
                    'ADRESS_TYP' => 'HOUSE',
                    'REFERENZ' => null,
                ]
            ],
            'address with number suffix' => [
                'address' => (new Address())
                    ->setFirstName('Oelie')
                    ->setLastName('Boelie')
                    ->setCity('Berlin')
                    ->setCountryIso3('DEU')
                    ->setStreet('Teststreet 123g')
                    ->setZip('12345')
                    ->setAdditionalAddressLine1('Test GmbH'),
                'expected' => [
                    'NAME' => 'Oelie Boelie',
                    'ZUSATZ' => 'Test GmbH',
                    'STRASSE' => 'Teststreet',
                    'NUMMER' => '123g',
                    'PLZ' => '12345',
                    'STADT' => 'Berlin',
                    'LAND' => 'DEU',
                    'ADRESS_TYP' => 'HOUSE',
                    'REFERENZ' => null,
                ]
            ],
            'address with number before street' => [
                'address' => (new Address())
                    ->setFirstName('Oelie')
                    ->setLastName('Boelie')
                    ->setCity('Berlin')
                    ->setCountryIso3('DEU')
                    ->setStreet('123 Teststreet')
                    ->setZip('12345')
                    ->setAdditionalAddressLine1('Test GmbH'),
                'expected' => [
                    'NAME' => 'Oelie Boelie',
                    'ZUSATZ' => 'Test GmbH',
                    'STRASSE' => 'Teststreet',
                    'NUMMER' => '123',
                    'PLZ' => '12345',
                    'STADT' => 'Berlin',
                    'LAND' => 'DEU',
                    'ADRESS_TYP' => 'HOUSE',
                    'REFERENZ' => null,
                ]
            ],
            'address with number range' => [
                'address' => (new Address())
                    ->setFirstName('Oelie')
                    ->setLastName('Boelie')
                    ->setCity('Berlin')
                    ->setCountryIso3('DEU')
                    ->setStreet('123-125 Teststreet')
                    ->setZip('12345')
                    ->setAdditionalAddressLine1('Test GmbH'),
                'expected' => [
                    'NAME' => 'Oelie Boelie',
                    'ZUSATZ' => 'Test GmbH',
                    'STRASSE' => 'Teststreet',
                    'NUMMER' => '123-125',
                    'PLZ' => '12345',
                    'STADT' => 'Berlin',
                    'LAND' => 'DEU',
                    'ADRESS_TYP' => 'HOUSE',
                    'REFERENZ' => null,
                ]
            ],
            'address with capslock street' => [
                'address' => (new Address())
                    ->setFirstName('Oelie')
                    ->setLastName('Boelie')
                    ->setCity('Berlin')
                    ->setCountryIso3('DEU')
                    ->setStreet('123 TESTSTREET')
                    ->setZip('12345')
                    ->setAdditionalAddressLine1('Test GmbH'),
                'expected' => [
                    'NAME' => 'Oelie Boelie',
                    'ZUSATZ' => 'Test GmbH',
                    'STRASSE' => 'TESTSTREET',
                    'NUMMER' => '123',
                    'PLZ' => '12345',
                    'STADT' => 'Berlin',
                    'LAND' => 'DEU',
                    'ADRESS_TYP' => 'HOUSE',
                    'REFERENZ' => null,
                ]
            ],
            'address with all small' => [
                'address' => (new Address())
                    ->setFirstName('Oelie')
                    ->setLastName('Boelie')
                    ->setCity('Berlin')
                    ->setCountryIso3('DEU')
                    ->setStreet('123 teststreet')
                    ->setZip('12345')
                    ->setAdditionalAddressLine1('Test GmbH'),
                'expected' => [
                    'NAME' => 'Oelie Boelie',
                    'ZUSATZ' => 'Test GmbH',
                    'STRASSE' => 'teststreet',
                    'NUMMER' => '123',
                    'PLZ' => '12345',
                    'STADT' => 'Berlin',
                    'LAND' => 'DEU',
                    'ADRESS_TYP' => 'HOUSE',
                    'REFERENZ' => null,
                ]
            ],
        ];
    }
}
