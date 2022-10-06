<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\AddressApi;
use T3G\DatahubApiLibrary\Entity\Address;
use T3G\DatahubApiLibrary\Exception\InvalidUuidException;

class AddressApiTest extends AbstractApiTest
{
    public function testGetUserAddress(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetAddressResponse.php',
        ]);
        $api = new AddressApi($this->getClient($handler));
        $response = $api->getUserAddress('00000000-0000-0000-0000-000000000000');
        self::assertEquals('00000000-0000-0000-0000-000000000000', $response->getUuid());
        self::assertEquals('Home', $response->getTitle());
        self::assertEquals('Musterstraße 123', $response->getStreet());
        self::assertEquals('12345', $response->getZip());
        self::assertEquals('Musterdorf', $response->getCity());
        self::assertEquals('Germany', $response->getCountryLabel());
        self::assertEquals('DE', $response->getCountry());
        self::assertEquals(16, $response->getType());
        self::assertTrue($response->isPostalAddress());
        $response->setDeliveryAddress(true);
        self::assertTrue($response->isPostalAddress());
        self::assertTrue($response->isDeliveryAddress());
    }

    public function testGetCompanyAddress(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetAddressResponse.php',
        ]);
        $api = new AddressApi($this->getClient($handler));
        $response = $api->getCompanyAddress('00000000-0000-0000-0000-000000000000');
        self::assertEquals('00000000-0000-0000-0000-000000000000', $response->getUuid());
        self::assertEquals('Home', $response->getTitle());
        self::assertEquals('Musterstraße 123', $response->getStreet());
        self::assertEquals('12345', $response->getZip());
        self::assertEquals('Musterdorf', $response->getCity());
        self::assertEquals('Germany', $response->getCountryLabel());
        self::assertEquals('DE', $response->getCountry());
        self::assertEquals(16, $response->getType());
        self::assertTrue($response->isPostalAddress());
        $response->setDeliveryAddress(true);
        self::assertTrue($response->isPostalAddress());
        self::assertTrue($response->isDeliveryAddress());
    }

    public function testCreateAddressForUser(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetAddressResponse.php',
        ]);
        $api = new AddressApi($this->getClient($handler));
        $response = $api->createAddressForUser('oelie-boelie', $this->getTestAddress());
        self::assertEquals('00000000-0000-0000-0000-000000000000', $response->getUuid());
        self::assertEquals('Home', $response->getTitle());
        self::assertEquals('Musterstraße 123', $response->getStreet());
        self::assertEquals('12345', $response->getZip());
        self::assertEquals('Musterdorf', $response->getCity());
        self::assertEquals('DE', $response->getCountry());
        self::assertEquals('DE-NW', $response->getState());
    }

    public function testCreateAddressForCompany(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetAddressResponse.php',
        ]);
        $api = new AddressApi($this->getClient($handler));
        $response = $api->createAddressForCompany('00000000-0000-0000-0000-000000000000', $this->getTestAddress());
        self::assertEquals('00000000-0000-0000-0000-000000000000', $response->getUuid());
        self::assertEquals('Home', $response->getTitle());
        self::assertEquals('Musterstraße 123', $response->getStreet());
        self::assertEquals('12345', $response->getZip());
        self::assertEquals('Musterdorf', $response->getCity());
        self::assertEquals('DE', $response->getCountry());
        self::assertEquals('DE-NW', $response->getState());
    }

    public function testUpdateUserAddress(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetAddressResponse.php',
        ]);
        $api = new AddressApi($this->getClient($handler));
        $response = $api->updateUserAddress('00000000-0000-0000-0000-000000000000', $this->getTestAddress());
        self::assertEquals('Home', $response->getTitle());
        self::assertEquals('00000000-0000-0000-0000-000000000000', $response->getUuid());
        self::assertEquals('Musterstraße 123', $response->getStreet());
        self::assertEquals('12345', $response->getZip());
        self::assertEquals('Musterdorf', $response->getCity());
        self::assertEquals('DE', $response->getCountry());
    }

    public function testUpdateCompanyAddress(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetAddressResponse.php',
        ]);
        $api = new AddressApi($this->getClient($handler));
        $response = $api->updateCompanyAddress('00000000-0000-0000-0000-000000000000', $this->getTestAddress());
        self::assertEquals('Home', $response->getTitle());
        self::assertEquals('00000000-0000-0000-0000-000000000000', $response->getUuid());
        self::assertEquals('Musterstraße 123', $response->getStreet());
        self::assertEquals('12345', $response->getZip());
        self::assertEquals('Musterdorf', $response->getCity());
        self::assertEquals('DE', $response->getCountry());
    }

    public function testDeleteUserAddress(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php',
        ]);
        $api = new AddressApi($this->getClient($handler));
        $api->deleteUserAddress('00000000-0000-0000-0000-000000000000');
        $this->expectException(InvalidUuidException::class);
        $api->deleteCompanyAddress('lidl');
    }

    public function testDeleteCompanyAddress(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php',
        ]);
        $api = new AddressApi($this->getClient($handler));
        $api->deleteCompanyAddress('00000000-0000-0000-0000-000000000000');
        $this->expectException(InvalidUuidException::class);
        $api->deleteCompanyAddress('lidl');
    }

    private function getTestAddress(): Address
    {
        return (new Address())
            ->setUuid('00000000-0000-0000-0000-000000000000')
            ->setTitle('Home')
            ->setFirstName('Max')
            ->setLastName('Mustermann')
            ->setAdditionalAddressLine1('Musterabteilung')
            ->setAdditionalAddressLine2('Sondermuster')
            ->setCity('Musterdorf')
            ->setCountry('Germany')
            ->setStreet('Musterstraße 123')
            ->setZip('12345')
            ->setType(2);
    }
}
