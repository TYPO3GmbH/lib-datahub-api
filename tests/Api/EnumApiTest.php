<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\EnumApi;

class EnumApiTest extends AbstractApiTest
{
    public function testGetCertificationStatusses(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCertificationStatussesEnumResponse.php',
        ]);
        $api = new EnumApi($this->getClient($handler));
        $response = $api->getCertificationStatusses();
        self::assertContains('Passed', $response);
        self::assertArrayHasKey('PASSED', $response);
    }

    public function testGetCertificationTypes(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCertificationTypesEnumResponse.php',
        ]);
        $api = new EnumApi($this->getClient($handler));
        $response = $api->getCertificationTypes();
        self::assertIsArray($response);
        self::assertContains('TCCI', $response);
        self::assertArrayHasKey('TCCI', $response);
    }

    public function testGetEmployeeRoles(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetEmployeeRolesEnumResponse.php',
        ]);
        $api = new EnumApi($this->getClient($handler));
        $response = $api->getEmployeeRoles();
        self::assertIsArray($response);
        self::assertContains('Employee', $response);
        self::assertArrayHasKey('EMPLOYEE', $response);
    }

    public function testGetMembershipTypes(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetMembershipTypesEnumResponse.php',
        ]);
        $api = new EnumApi($this->getClient($handler));
        $response = $api->getMembershipTypes();
        self::assertIsArray($response);
        self::assertContains('Community', $response);
        self::assertArrayHasKey('COMMUNITY', $response);
    }

    public function testGetLinkTypes(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetLinkTypesEnumResponse.php',
        ]);
        $api = new EnumApi($this->getClient($handler));
        $response = $api->getLinkTypes();
        self::assertIsArray($response);
        self::assertContains('Github', $response);
        self::assertArrayHasKey('github', $response);
    }

    public function testGetSubscriptionTypes(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetSubscriptionTypesEnumResponse.php',
        ]);
        $api = new EnumApi($this->getClient($handler));
        $response = $api->getSubscriptionTypes();
        self::assertIsArray($response);
        self::assertContains('Membership', $response);
        self::assertArrayHasKey('membership', $response);
        self::assertContains('Professional Service Listing', $response);
        self::assertArrayHasKey('psl', $response);
    }

    public function testGetSubscriptionStatus(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetSubscriptionStatusEnumResponse.php',
        ]);
        $api = new EnumApi($this->getClient($handler));
        $response = $api->getSubscriptionTypes();
        self::assertIsArray($response);
        self::assertContains('Active subscription', $response);
        self::assertArrayHasKey('active', $response);
        self::assertContains('Past due payment', $response);
        self::assertArrayHasKey('past_due', $response);
    }

    public function testGetCompanyDeletionPreCheckTypesEnumResponse(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCompanyDeletionPreCheckTypesEnumResponse.php',
        ]);
        $api = new EnumApi($this->getClient($handler));
        $response = $api->getCompanyDeletionPreCheckTypes();
        self::assertIsArray($response);
        self::assertContains('Info', $response);
        self::assertArrayHasKey('info', $response);
        self::assertContains('Blocking', $response);
        self::assertArrayHasKey('blocking', $response);
    }

    public function testGetTransferableTypesEnumResponse(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetTransferableTypesEnumResponse.php',
        ]);
        $api = new EnumApi($this->getClient($handler));
        $response = $api->getTransferableTypes();
        self::assertIsArray($response);
        self::assertContains('elts', $response);
        self::assertArrayHasKey('elts', $response);
    }
}
