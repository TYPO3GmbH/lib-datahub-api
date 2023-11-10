<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\ResourceApi;

class ResourceApiTest extends AbstractApiTestCase
{
    public function testGetUser(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserResponse.php',
        ]);
        $api = new ResourceApi($this->getClient($handler));
        $response = $api->getUser('oelie-boelie');
        self::assertEquals('oelie-boelie', $response->getUsername());
        self::assertCount(2, $response->getAddresses());
        self::assertCount(2, $response->getPostalAddresses());
        self::assertCount(2, $response->getLinks());
        self::assertCount(1, $response->getCertifications());
        self::assertEquals('COMMUNITY', $response->getMembership()->getSubscriptionSubType());
    }

    public function testGetUserList(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserListResponse.php',
        ]);
        $api = new ResourceApi($this->getClient($handler));
        $response = $api->getUserList(['max.muster', 'fritz.fuscher'], ['user.base']);
        self::assertCount(2, $response);
        self::assertEquals('max.muster', $response[0]->getUsername());
        self::assertEquals('fritz.fuscher', $response[1]->getUsername());
        self::assertNull($response[0]->getFirstName());
        self::assertNull($response[1]->getFirstName());
    }

    public function testGetUserListWithNames(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserListWithNamesResponse.php',
        ]);
        $api = new ResourceApi($this->getClient($handler));
        $response = $api->getUserList(['max.muster', 'fritz.fuscher'], ['user.base', 'user.name']);
        self::assertCount(2, $response);
        self::assertEquals('max.muster', $response[0]->getUsername());
        self::assertEquals('fritz.fuscher', $response[1]->getUsername());
        self::assertEquals('Max', $response[0]->getFirstName());
        self::assertEquals('Fritz', $response[1]->getFirstName());
    }

    public function testGetCertification(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetResourceCertificationResponse.php',
        ]);
        $api = new ResourceApi($this->getClient($handler));
        $response = $api->getCertification('00000000-0000-0000-0000-000000000000');
        self::assertEquals('00000000-0000-0000-0000-000000000000', $response->getUuid());
        self::assertEquals('TCCC', $response->getType());
        self::assertEquals('10.4', $response->getVersion());
        self::assertEquals('Certifuncation', $response->getExamLocation());
        self::assertEquals('PASSED', $response->getExamTestResult());
        self::assertEquals('PRESENCE', $response->getAuditType());
        self::assertEquals('PREPARATION_REQUIRED', $response->getStatus());
    }

    public function testGetCertificationList(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetResourceCertificationListResponse.php',
        ]);
        $api = new ResourceApi($this->getClient($handler));
        $response = $api->getCertificationList(['00000000-0000-0000-0000-000000000000']);
        self::assertCount(1, $response);
        self::assertEquals('00000000-0000-0000-0000-000000000000', $response[0]->getUuid());
        self::assertEquals('TCCC', $response[0]->getType());
        self::assertEquals('10.4', $response[0]->getVersion());
        self::assertEquals('Certifuncation', $response[0]->getExamLocation());
        self::assertEquals('PASSED', $response[0]->getExamTestResult());
        self::assertEquals('PRESENCE', $response[0]->getAuditType());
        self::assertEquals('PREPARATION_REQUIRED', $response[0]->getStatus());
    }
}
