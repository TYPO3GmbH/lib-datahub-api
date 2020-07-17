<?php declare(strict_types=1);

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
            require __DIR__ . '/../Fixtures/GetAddressResponse.php'
        ]);
        $api = new AddressApi($this->getClient($handler));
        $response = $api->getUserAddress('00000000-0000-0000-0000-000000000000');
        $this->assertEquals('00000000-0000-0000-0000-000000000000', $response->getUuid());
        $this->assertEquals('Home', $response->getTitle());
        $this->assertEquals('Musterstraße 123', $response->getStreet());
        $this->assertEquals('12345', $response->getZip());
        $this->assertEquals('Musterdorf', $response->getCity());
        $this->assertEquals('Germany', $response->getCountryLabel());
        $this->assertEquals('DE', $response->getCountry());
        $this->assertEquals(16, $response->getType());
        $this->assertTrue($response->isPostalAddress());
        $response->setDeliveryAddress(true);
        $this->assertTrue($response->isPostalAddress());
        $this->assertTrue($response->isDeliveryAddress());
    }

    public function testGetCompanyAddress(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetAddressResponse.php'
        ]);
        $api = new AddressApi($this->getClient($handler));
        $response = $api->getCompanyAddress('00000000-0000-0000-0000-000000000000');
        $this->assertEquals('00000000-0000-0000-0000-000000000000', $response->getUuid());
        $this->assertEquals('Home', $response->getTitle());
        $this->assertEquals('Musterstraße 123', $response->getStreet());
        $this->assertEquals('12345', $response->getZip());
        $this->assertEquals('Musterdorf', $response->getCity());
        $this->assertEquals('Germany', $response->getCountryLabel());
        $this->assertEquals('DE', $response->getCountry());
        $this->assertEquals(16, $response->getType());
        $this->assertTrue($response->isPostalAddress());
        $response->setDeliveryAddress(true);
        $this->assertTrue($response->isPostalAddress());
        $this->assertTrue($response->isDeliveryAddress());
    }

    public function testCreateAddressForUser(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetAddressResponse.php'
        ]);
        $api = new AddressApi($this->getClient($handler));
        $response = $api->createAddressForUser('oelie-boelie', $this->getTestAddress());
        $this->assertEquals('00000000-0000-0000-0000-000000000000', $response->getUuid());
        $this->assertEquals('Home', $response->getTitle());
        $this->assertEquals('Musterstraße 123', $response->getStreet());
        $this->assertEquals('12345', $response->getZip());
        $this->assertEquals('Musterdorf', $response->getCity());
        $this->assertEquals('DE', $response->getCountry());
        $this->assertEquals('DE-NW', $response->getState());
    }

    public function testCreateAddressForCompany(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetAddressResponse.php'
        ]);
        $api = new AddressApi($this->getClient($handler));
        $response = $api->createAddressForCompany('00000000-0000-0000-0000-000000000000', $this->getTestAddress());
        $this->assertEquals('00000000-0000-0000-0000-000000000000', $response->getUuid());
        $this->assertEquals('Home', $response->getTitle());
        $this->assertEquals('Musterstraße 123', $response->getStreet());
        $this->assertEquals('12345', $response->getZip());
        $this->assertEquals('Musterdorf', $response->getCity());
        $this->assertEquals('DE', $response->getCountry());
        $this->assertEquals('DE-NW', $response->getState());
    }

    public function testUpdateUserAddress(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetAddressResponse.php'
        ]);
        $api = new AddressApi($this->getClient($handler));
        $response = $api->updateUserAddress('00000000-0000-0000-0000-000000000000', $this->getTestAddress());
        $this->assertEquals('Home', $response->getTitle());
        $this->assertEquals('00000000-0000-0000-0000-000000000000', $response->getUuid());
        $this->assertEquals('Musterstraße 123', $response->getStreet());
        $this->assertEquals('12345', $response->getZip());
        $this->assertEquals('Musterdorf', $response->getCity());
        $this->assertEquals('DE', $response->getCountry());
    }

    public function testUpdateCompanyAddress(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetAddressResponse.php'
        ]);
        $api = new AddressApi($this->getClient($handler));
        $response = $api->updateCompanyAddress('00000000-0000-0000-0000-000000000000', $this->getTestAddress());
        $this->assertEquals('Home', $response->getTitle());
        $this->assertEquals('00000000-0000-0000-0000-000000000000', $response->getUuid());
        $this->assertEquals('Musterstraße 123', $response->getStreet());
        $this->assertEquals('12345', $response->getZip());
        $this->assertEquals('Musterdorf', $response->getCity());
        $this->assertEquals('DE', $response->getCountry());
    }

    public function testDeleteUserAddress(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php'
        ]);
        $api = new AddressApi($this->getClient($handler));
        $api->deleteUserAddress('00000000-0000-0000-0000-000000000000');
        $this->expectException(InvalidUuidException::class);
        $api->deleteCompanyAddress('lidl');
    }

    public function testDeleteCompanyAddress(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php'
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
