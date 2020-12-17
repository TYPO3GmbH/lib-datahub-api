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
use T3G\DatahubApiLibrary\Enum\CompanyType;
use T3G\DatahubApiLibrary\Enum\PSLType;
use T3G\DatahubApiLibrary\Enum\SubscriptionStatus;
use T3G\DatahubApiLibrary\Enum\SubscriptionType;

class CompanyApiTest extends AbstractApiTest
{
    public function testGetCompany(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCompanyResponse.php'
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->getCompany('00000000-0000-0000-0000-000000000000');
        $this->assertEquals(CompanyType::AGENCY, $response->getCompanyType());
        $this->assertEquals('Test Company', $response->getTitle());
        $this->assertEquals('test-company', $response->getSlug());
        $this->assertEquals('typo3.com', $response->getDomain());
        $this->assertCount(4, $response->getEmployees());
        $this->assertCount(2, $response->getAddresses());
        $this->assertCount(2, $response->getPostalAddresses());
        $this->assertEquals('GOLD', $response->getMembership()->getSubscriptionSubType());
        $this->assertEquals(true, $response->isFoundingPartner());
        $this->assertEquals(true, $response->isPsl());
    }

    public function testDeletionPreCheck(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetDeletionPreCheckResponse.php'
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->deletionPreCheck('00000000-0000-0000-0000-000000000000');
        $this->assertCount(2, $response);
        $this->assertEquals('App\\Service\\CompanyPreDeletionCheck\\AddressesPreCheck', $response[0]->getSource());
        $this->assertEquals('info', $response[0]->getType());
        $this->assertEquals(true, $response[0]->getResult());
        $this->assertEquals(['amountOfAddresses' => 0], $response[0]->getAdditionalData());
        $this->assertEquals('App\\Service\\CompanyPreDeletionCheck\\MembersPreCheck', $response[1]->getSource());
        $this->assertEquals('blocking', $response[1]->getType());
        $this->assertEquals(false, $response[1]->getResult());
        $this->assertEquals(['amountOfEmployees' => 1, 'amountOfInvitations' => 0], $response[1]->getAdditionalData());
    }

    public function testGetCompanyWithOrders(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCompanyResponseWithOrders.php'
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->getCompany('00000000-0000-0000-0000-000000000000', true);
        $this->assertEquals(CompanyType::AGENCY, $response->getCompanyType());
        $this->assertEquals('Test Company', $response->getTitle());
        $this->assertEquals('test-company', $response->getSlug());
        $orders = $response->getOrders();
        $this->assertCount(1, $orders);
        $this->assertSame('A12345', $orders[0]->getOrderNumber());
        $this->assertSame(['items' => [['foo' => 'bar']]], $orders[0]->getPayload());
    }

    public function testGetCompanyWithSubscriptions(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCompanyResponseWithSubscriptions.php'
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->getCompany('00000000-0000-0000-0000-000000000000', false, true);
        $this->assertEquals(CompanyType::AGENCY, $response->getCompanyType());
        $this->assertEquals('Test Company', $response->getTitle());
        $this->assertEquals('test-company', $response->getSlug());
        $subscriptions = $response->getSubscriptions();
        $this->assertCount(3, $subscriptions);
        $this->assertEquals('GOLD', $response->getMembership()->getSubscriptionSubType());

        $this->assertSame('00000000-0000-0000-0000-000000000000', $subscriptions[0]->getUuid());
        $this->assertSame('sub_AAAAAAAAA', $subscriptions[0]->getSubscriptionIdentifier());
        $this->assertSame(SubscriptionType::PSL, $subscriptions[0]->getSubscriptionType());
        $this->assertSame(PSLType::MAP_VIEW, $subscriptions[0]->getSubscriptionSubType());
        $this->assertSame(SubscriptionStatus::ACTIVE, $subscriptions[0]->getSubscriptionStatus());
        $this->assertSame(['items' => [['foo' => 'bar']]], $subscriptions[0]->getPayload());

        $this->assertSame('11111111-1111-1111-1111-111111111111', $subscriptions[1]->getUuid());
        $this->assertSame('sub_BBBBBBBBB', $subscriptions[1]->getSubscriptionIdentifier());
        $this->assertSame(SubscriptionType::PSL, $subscriptions[1]->getSubscriptionType());
        $this->assertSame(PSLType::PROFILE_BUNDLE, $subscriptions[1]->getSubscriptionSubType());
        $this->assertSame(SubscriptionStatus::INCOMPLETE_EXPIRED, $subscriptions[1]->getSubscriptionStatus());
        $this->assertSame(['items' => [['foo' => 'bar']]], $subscriptions[1]->getPayload());
    }

    public function testGetSearchCompanies(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetSearchCompanyResponse.php'
        ]);
        $response = (new CompanyApi($this->getClient($handler)))
            ->search('Test Company');
        $this->assertEquals(2, count($response));
    }

    public function testCreateCompany(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCompanyResponse.php'
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->createCompany($this->getTestCompany());
        $this->assertEquals(CompanyType::AGENCY, $response->getCompanyType());
        $this->assertEquals('Test Company', $response->getTitle());
        $this->assertEquals('test-company', $response->getSlug());
    }

    public function testUpdateCompany(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCompanyResponse.php'
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->updateCompany('00000000-0000-0000-0000-000000000000', $this->getTestCompany());
        $this->assertEquals('Test Company', $response->getTitle());
        $this->assertEquals('test-company', $response->getSlug());
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
        $this->assertEquals('oelie@boelie.nl', $response->getUser()->getPrimaryEmail());
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
        $this->assertEquals('oelie@boelie.nl', $response->getUser()->getPrimaryEmail());
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
            ->setDomain('typo3.com')
            ->setEmail('test@example.com')
            ->setVatId('DE123456789');
    }
}
