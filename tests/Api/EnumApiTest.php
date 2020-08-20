<?php declare(strict_types=1);

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
            require __DIR__ . '/../Fixtures/GetCertificationStatussesEnumResponse.php'
        ]);
        $api = new EnumApi($this->getClient($handler));
        $response = $api->getCertificationStatusses();
        $this->assertContains('Passed', $response);
        $this->assertArrayHasKey('PASSED', $response);
    }

    public function testGetCertificationTypes(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCertificationTypesEnumResponse.php'
        ]);
        $api = new EnumApi($this->getClient($handler));
        $response = $api->getCertificationTypes();
        $this->assertIsArray($response);
        $this->assertContains('TCCI', $response);
        $this->assertArrayHasKey('TCCI', $response);
    }

    public function testGetEmployeeRoles(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetEmployeeRolesEnumResponse.php'
        ]);
        $api = new EnumApi($this->getClient($handler));
        $response = $api->getEmployeeRoles();
        $this->assertIsArray($response);
        $this->assertContains('Employee', $response);
        $this->assertArrayHasKey('EMPLOYEE', $response);
    }

    public function testGetMembershipTypes(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetMembershipTypesEnumResponse.php'
        ]);
        $api = new EnumApi($this->getClient($handler));
        $response = $api->getMembershipTypes();
        $this->assertIsArray($response);
        $this->assertContains('Community', $response);
        $this->assertArrayHasKey('COMMUNITY', $response);
    }

    public function testGetLinkTypes(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetLinkTypesEnumResponse.php'
        ]);
        $api = new EnumApi($this->getClient($handler));
        $response = $api->getLinkTypes();
        $this->assertIsArray($response);
        $this->assertContains('Github', $response);
        $this->assertArrayHasKey('github', $response);
    }

    public function testGetSubscriptionTypes(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetSubscriptionTypesEnumResponse.php'
        ]);
        $api = new EnumApi($this->getClient($handler));
        $response = $api->getSubscriptionTypes();
        $this->assertIsArray($response);
        $this->assertContains('Membership', $response);
        $this->assertArrayHasKey('membership', $response);
        $this->assertContains('Professional Service Listing', $response);
        $this->assertArrayHasKey('psl', $response);
    }
}
