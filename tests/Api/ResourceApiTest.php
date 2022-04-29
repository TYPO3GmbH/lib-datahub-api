<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\ResourceApi;

class ResourceApiTest extends AbstractApiTest
{
    public function testGetUser(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserResponse.php'
        ]);
        $api = new ResourceApi($this->getClient($handler));
        $response = $api->getUser('oelie-boelie');
        $this->assertEquals('oelie-boelie', $response->getUsername());
        $this->assertCount(2, $response->getAddresses());
        $this->assertCount(2, $response->getPostalAddresses());
        $this->assertCount(2, $response->getLinks());
        $this->assertCount(1, $response->getCertifications());
        $this->assertEquals('ACADEMIC_BRONZE', $response->getMembership()->getSubscriptionSubType());
    }

    public function testGetUserList(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserListResponse.php'
        ]);
        $api = new ResourceApi($this->getClient($handler));
        $response = $api->getUserList(['max.muster', 'fritz.fuscher'], ['user.base']);
        $this->assertCount(2, $response);
        $this->assertEquals('max.muster', $response[0]->getUsername());
        $this->assertEquals('fritz.fuscher', $response[1]->getUsername());
        $this->assertEquals(null, $response[0]->getFirstName());
        $this->assertEquals(null, $response[1]->getFirstName());
    }

    public function testGetUserListWithNames(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserListWithNamesResponse.php'
        ]);
        $api = new ResourceApi($this->getClient($handler));
        $response = $api->getUserList(['max.muster', 'fritz.fuscher'], ['user.base', 'user.name']);
        $this->assertCount(2, $response);
        $this->assertEquals('max.muster', $response[0]->getUsername());
        $this->assertEquals('fritz.fuscher', $response[1]->getUsername());
        $this->assertEquals('Max', $response[0]->getFirstName());
        $this->assertEquals('Fritz', $response[1]->getFirstName());
    }
}
