<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Entity;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Entity\Address;

class AddressTest extends TestCase
{
    #[DataProvider('deutschePostDataProvider')]
    public function testDeutschePostAddressConversion(Address $address, array $expected): void
    {
        self::assertEquals($expected, $address->toDeutschePostArray());
    }

    public static function deutschePostDataProvider(): array
    {
        return [
            'basic address' => [
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
                    'NAME2' => '',
                    'ZUSATZ' => 'Test GmbH',
                    'STRASSE' => 'Teststreet',
                    'NUMMER' => '123',
                    'PLZ' => '12345',
                    'STADT' => 'Berlin',
                    'LAND' => 'DEU',
                    'ADRESS_TYP' => 'HOUSE',
                    'REFERENZ' => null,
                ],
            ],
            'company address' => [
                'address' => (new Address())
                    ->setCompanyName('Company Name')
                    ->setCity('Berlin')
                    ->setCountryIso3('DEU')
                    ->setStreet('Teststreet 123')
                    ->setZip('12345')
                    ->setAdditionalAddressLine1('Department B'),
                'expected' => [
                    'NAME' => 'Company Name',
                    'NAME2' => '',
                    'ZUSATZ' => 'Department B',
                    'STRASSE' => 'Teststreet',
                    'NUMMER' => '123',
                    'PLZ' => '12345',
                    'STADT' => 'Berlin',
                    'LAND' => 'DEU',
                    'ADRESS_TYP' => 'HOUSE',
                    'REFERENZ' => null,
                ],
            ],
            'complete address' => [
                'address' => (new Address())
                    ->setCompanyName('Company Name')
                    ->setFirstName('Oelie')
                    ->setLastName('Boelie')
                    ->setCity('Berlin')
                    ->setCountryIso3('DEU')
                    ->setStreet('Teststreet 123')
                    ->setZip('12345')
                    ->setAdditionalAddressLine1('Test GmbH'),
                'expected' => [
                    'NAME' => 'Company Name',
                    'NAME2' => 'Oelie Boelie',
                    'ZUSATZ' => 'Test GmbH',
                    'STRASSE' => 'Teststreet',
                    'NUMMER' => '123',
                    'PLZ' => '12345',
                    'STADT' => 'Berlin',
                    'LAND' => 'DEU',
                    'ADRESS_TYP' => 'HOUSE',
                    'REFERENZ' => null,
                ],
            ],
            'address with special characters' => [
                'address' => (new Address())
                    ->setFirstName('Øelie')
                    ->setLastName('Bőelie')
                    ->setCity('Bérlin')
                    ->setCountryIso3('DEU')
                    ->setStreet('Sträßchenweg 123')
                    ->setZip('12345')
                    ->setAdditionalAddressLine1('Tæçt GmbH'),
                'expected' => [
                    'NAME' => 'Oelie Boelie',
                    'NAME2' => '',
                    'ZUSATZ' => 'Taect GmbH',
                    'STRASSE' => 'Straesschenweg',
                    'NUMMER' => '123',
                    'PLZ' => '12345',
                    'STADT' => 'Berlin',
                    'LAND' => 'DEU',
                    'ADRESS_TYP' => 'HOUSE',
                    'REFERENZ' => null,
                ],
            ],
            'address with foreign charsets (russian)' => [
                'address' => (new Address())
                    ->setFirstName('Анна')
                    ->setLastName('Мюстер')
                    ->setCity('Düsseldorf')
                    ->setCountryIso3('DEU')
                    ->setStreet('Sträßchenweg 123')
                    ->setZip('12345')
                    ->setAdditionalAddressLine1('Tæçt GmbH'),
                'expected' => [
                    'NAME' => 'Anna Muster',
                    'NAME2' => '',
                    'ZUSATZ' => 'Taect GmbH',
                    'STRASSE' => 'Straesschenweg',
                    'NUMMER' => '123',
                    'PLZ' => '12345',
                    'STADT' => 'Duesseldorf',
                    'LAND' => 'DEU',
                    'ADRESS_TYP' => 'HOUSE',
                    'REFERENZ' => null,
                ],
            ],
            'address with foreign charsets (chinese)' => [
                'address' => (new Address())
                    ->setFirstName('安娜')
                    ->setLastName('穆斯特')
                    ->setCity('Düsseldorf')
                    ->setCountryIso3('DEU')
                    ->setStreet('Sträßchenweg 123')
                    ->setZip('12345')
                    ->setAdditionalAddressLine1('Tæçt GmbH'),
                'expected' => [
                    'NAME' => 'an na mu si te',
                    'NAME2' => '',
                    'ZUSATZ' => 'Taect GmbH',
                    'STRASSE' => 'Straesschenweg',
                    'NUMMER' => '123',
                    'PLZ' => '12345',
                    'STADT' => 'Duesseldorf',
                    'LAND' => 'DEU',
                    'ADRESS_TYP' => 'HOUSE',
                    'REFERENZ' => null,
                ],
            ],
            'address with foreign charsets (greek)' => [
                'address' => (new Address())
                    ->setFirstName('Άννα')
                    ->setLastName('Μάστερ')
                    ->setCity('Düsseldorf')
                    ->setCountryIso3('DEU')
                    ->setStreet('Sträßchenweg 123')
                    ->setZip('12345')
                    ->setAdditionalAddressLine1('Tæçt GmbH'),
                'expected' => [
                    'NAME' => 'Anna Master',
                    'NAME2' => '',
                    'ZUSATZ' => 'Taect GmbH',
                    'STRASSE' => 'Straesschenweg',
                    'NUMMER' => '123',
                    'PLZ' => '12345',
                    'STADT' => 'Duesseldorf',
                    'LAND' => 'DEU',
                    'ADRESS_TYP' => 'HOUSE',
                    'REFERENZ' => null,
                ],
            ],
            'address with foreign charsets (hindi)' => [
                'address' => (new Address())
                    ->setFirstName('अन्ना')
                    ->setLastName('मस्टर')
                    ->setCity('Düsseldorf')
                    ->setCountryIso3('DEU')
                    ->setStreet('Sträßchenweg 123')
                    ->setZip('12345')
                    ->setAdditionalAddressLine1('Tæçt GmbH'),
                'expected' => [
                    'NAME' => 'anna mastara',
                    'NAME2' => '',
                    'ZUSATZ' => 'Taect GmbH',
                    'STRASSE' => 'Straesschenweg',
                    'NUMMER' => '123',
                    'PLZ' => '12345',
                    'STADT' => 'Duesseldorf',
                    'LAND' => 'DEU',
                    'ADRESS_TYP' => 'HOUSE',
                    'REFERENZ' => null,
                ],
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
                    'NAME2' => '',
                    'ZUSATZ' => 'Test GmbH',
                    'STRASSE' => 'Teststreet',
                    'NUMMER' => '123g',
                    'PLZ' => '12345',
                    'STADT' => 'Berlin',
                    'LAND' => 'DEU',
                    'ADRESS_TYP' => 'HOUSE',
                    'REFERENZ' => null,
                ],
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
                    'NAME2' => '',
                    'ZUSATZ' => 'Test GmbH',
                    'STRASSE' => 'Teststreet',
                    'NUMMER' => '123',
                    'PLZ' => '12345',
                    'STADT' => 'Berlin',
                    'LAND' => 'DEU',
                    'ADRESS_TYP' => 'HOUSE',
                    'REFERENZ' => null,
                ],
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
                    'NAME2' => '',
                    'ZUSATZ' => 'Test GmbH',
                    'STRASSE' => 'Teststreet',
                    'NUMMER' => '123-125',
                    'PLZ' => '12345',
                    'STADT' => 'Berlin',
                    'LAND' => 'DEU',
                    'ADRESS_TYP' => 'HOUSE',
                    'REFERENZ' => null,
                ],
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
                    'NAME2' => '',
                    'ZUSATZ' => 'Test GmbH',
                    'STRASSE' => 'TESTSTREET',
                    'NUMMER' => '123',
                    'PLZ' => '12345',
                    'STADT' => 'Berlin',
                    'LAND' => 'DEU',
                    'ADRESS_TYP' => 'HOUSE',
                    'REFERENZ' => null,
                ],
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
                    'NAME2' => '',
                    'ZUSATZ' => 'Test GmbH',
                    'STRASSE' => 'teststreet',
                    'NUMMER' => '123',
                    'PLZ' => '12345',
                    'STADT' => 'Berlin',
                    'LAND' => 'DEU',
                    'ADRESS_TYP' => 'HOUSE',
                    'REFERENZ' => null,
                ],
            ],
        ];
    }
}
