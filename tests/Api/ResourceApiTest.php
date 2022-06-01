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

    public function testGetCertification(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetResourceCertificationResponse.php'
        ]);
        $api = new ResourceApi($this->getClient($handler));
        $response = $api->getCertification('00000000-0000-0000-0000-000000000000');
        $this->assertEquals('00000000-0000-0000-0000-000000000000', $response->getUuid());
        $this->assertEquals('TCCC', $response->getType());
        $this->assertEquals('10.4', $response->getVersion());
        $this->assertEquals('Certifuncation', $response->getExamLocation());
        $this->assertEquals('PASSED', $response->getExamTestResult());
        $this->assertEquals('PRESENCE', $response->getAuditType());
        $this->assertEquals('PREPARATION_REQUIRED', $response->getStatus());
    }

    public function testGetCertificationList(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetResourceCertificationListResponse.php'
        ]);
        $api = new ResourceApi($this->getClient($handler));
        $response = $api->getCertificationList(['00000000-0000-0000-0000-000000000000']);
        $this->assertCount(1, $response);
        $this->assertEquals('00000000-0000-0000-0000-000000000000', $response[0]->getUuid());
        $this->assertEquals('TCCC', $response[0]->getType());
        $this->assertEquals('10.4', $response[0]->getVersion());
        $this->assertEquals('Certifuncation', $response[0]->getExamLocation());
        $this->assertEquals('PASSED', $response[0]->getExamTestResult());
        $this->assertEquals('PRESENCE', $response[0]->getAuditType());
        $this->assertEquals('PREPARATION_REQUIRED', $response[0]->getStatus());
    }
}
