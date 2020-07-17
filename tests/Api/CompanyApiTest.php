<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\CompanyApi;
use T3G\DatahubApiLibrary\Entity\Company;

class CompanyApiTest extends AbstractApiTest
{
    public function testGetCompany(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCompanyResponse.php'
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->getCompany('00000000-0000-0000-0000-000000000000');
        $this->assertEquals('Test Company', $response->getTitle());
        $this->assertCount(4, $response->getEmployees());
        $this->assertCount(2, $response->getAddresses());
        $this->assertCount(2, $response->getPostalAddresses());
        $this->assertEquals('COMMUNITY', $response->getMembership()->getType());
    }

    public function testGetCompanyWithOrders(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCompanyResponseWithOrders.php'
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->getCompany('00000000-0000-0000-0000-000000000000', true);
        $this->assertEquals('Test Company', $response->getTitle());
        $orders = $response->getOrders();
        $this->assertCount(1, $orders);
        $this->assertSame('A12345', $orders[0]->getOrderNumber());
        $this->assertSame(['items' => [['foo' => 'bar']]], $orders[0]->getPayload());
    }

    public function testCreateCompany(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCompanyResponse.php'
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->createCompany($this->getTestCompany());
        $this->assertEquals('Test Company', $response->getTitle());
    }

    public function testUpdateCompany(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCompanyResponse.php'
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->updateCompany('00000000-0000-0000-0000-000000000000', $this->getTestCompany());
        $this->assertEquals('Test Company', $response->getTitle());
        $this->assertCount(4, $response->getEmployees());
        $this->assertCount(2, $response->getAddresses());
    }

    public function testInviteEmployee(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCompanyInviteResponse.php'
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->inviteEmployee('00000000-0000-0000-0000-000000000000', 'oelie-boelie', 'EMPLOYEE');
        $this->assertEquals('oelie-boelie', $response->getUsername());
        $this->assertEquals('oelie@boelie.nl', $response->getEmail());
        $this->assertEquals('abcd', $response->getInviteCode());
    }

    public function testConfirmEmployee(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetConfirmCompanyInviteResponse.php'
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->confirmEmployeeInvitation('00000000-0000-0000-0000-000000000000');
        $this->assertEquals('oelie-boelie', $response->getUser()->getUsername());
        $this->assertEquals('oelie@boelie.nl', $response->getUser()->getEmail());
        $this->assertEquals('EMPLOYEE', $response->getRole());
    }

    public function testUpdateEmployee(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetEmployeeResponse.php'
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->updateEmployee('00000000-0000-0000-0000-000000000000', 'MANAGER');
        $this->assertEquals('oelie-boelie', $response->getUser()->getUsername());
        $this->assertEquals('oelie@boelie.nl', $response->getUser()->getEmail());
        $this->assertEquals('MANAGER', $response->getRole());
    }

    public function testGetInvitations(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCompanyInvitationsReponse.php'
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->getOpenInvitations('00000000-0000-0000-0000-000000000000');
        $this->assertCount(1, $response);
    }

    public function testDeleteCompany(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php'
        ]);
        $api = new CompanyApi($this->getClient($handler));
        try {
            $api->deleteCompany('00000000-0000-0000-0000-000000000000');
            $anExceptionWasThrown = false;
        } catch (\Exception $e) {
            $anExceptionWasThrown = true;
        }
        $this->assertFalse($anExceptionWasThrown);
    }

    public function testRevokeEmployeeInvitation(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php'
        ]);
        $api = new CompanyApi($this->getClient($handler));
        try {
            $api->revokeEmployeeInvitation('00000000-0000-0000-0000-000000000000', '00000000-0000-0000-0000-000000000000');
            $anExceptionWasThrown = false;
        } catch (\Exception $e) {
            $anExceptionWasThrown = true;
        }
        $this->assertFalse($anExceptionWasThrown);
    }

    public function testDeleteEmployee(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php'
        ]);
        $api = new CompanyApi($this->getClient($handler));
        try {
            $api->deleteEmployee('00000000-0000-0000-0000-000000000000');
            $anExceptionWasThrown = false;
        } catch (\Exception $e) {
            $anExceptionWasThrown = true;
        }
        $this->assertFalse($anExceptionWasThrown);
    }

    private function getTestCompany(): Company
    {
        return (new Company())
            ->setTitle('Test Company')
            ->setEmail('test@example.com')
            ->setVatId('DE123456789');
    }
}
