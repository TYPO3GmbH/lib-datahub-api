<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\CompanyApi;
use T3G\DatahubApiLibrary\Assembler\Admin\MergeCompanyAssembler;
use T3G\DatahubApiLibrary\Demand\OrganizationSearchDemand;
use T3G\DatahubApiLibrary\Entity\Company;
use T3G\DatahubApiLibrary\Enum\CompanyService;
use T3G\DatahubApiLibrary\Enum\CompanyType;
use T3G\DatahubApiLibrary\Enum\PSLType;
use T3G\DatahubApiLibrary\Enum\SubscriptionStatus;
use T3G\DatahubApiLibrary\Enum\SubscriptionType;

class CompanyApiTest extends AbstractApiTestCase
{
    public function testGetCompany(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCompanyResponse.php',
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->getCompany('00000000-0000-0000-0000-000000000000');
        self::assertEquals(CompanyType::AGENCY, $response->getCompanyType());
        self::assertEquals('Test Company', $response->getTitle());
        self::assertEquals('test-company', $response->getSlug());
        self::assertEquals('typo3.com', $response->getDomain());
        self::assertCount(4, $response->getEmployees());
        self::assertCount(2, $response->getAddresses());
        self::assertCount(2, $response->getPostalAddresses());
        self::assertEquals('GOLD', $response->getMembership()->getSubscriptionSubType());
        self::assertTrue($response->isFoundingPartner());
        self::assertTrue($response->isPsl());
        self::assertSame([
            CompanyService::DESIGN,
            CompanyService::DEVELOPMENT,
        ], $response->getOfferedServices());
        self::assertEquals([
            'isFoundingPartner' => true,
            'membership' => 'GOLD',
            'partnerType' => 'NONE',
        ], $response->getStatus());
    }

    public function testDeletionPreCheck(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetDeletionPreCheckResponse.php',
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->deletionPreCheck('00000000-0000-0000-0000-000000000000');
        self::assertCount(2, $response);
        self::assertEquals('App\\Service\\CompanyPreDeletionCheck\\AddressesPreCheck', $response[0]->getSource());
        self::assertEquals('info', $response[0]->getType());
        self::assertTrue($response[0]->getResult());
        self::assertEquals(['amountOfAddresses' => 0], $response[0]->getAdditionalData());
        self::assertEquals('App\\Service\\CompanyPreDeletionCheck\\MembersPreCheck', $response[1]->getSource());
        self::assertEquals('blocking', $response[1]->getType());
        self::assertFalse($response[1]->getResult());
        self::assertEquals(['amountOfEmployees' => 1, 'amountOfInvitations' => 0], $response[1]->getAdditionalData());
    }

    public function testGetCompanyWithOrders(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCompanyResponseWithOrders.php',
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->getCompany('00000000-0000-0000-0000-000000000000', true);
        self::assertEquals(CompanyType::AGENCY, $response->getCompanyType());
        self::assertEquals('Test Company', $response->getTitle());
        self::assertEquals('test-company', $response->getSlug());
        $orders = $response->getOrders();
        self::assertCount(1, $orders);
        self::assertSame('A12345', $orders[0]->getOrderNumber());
        self::assertSame(['items' => [['foo' => 'bar']]], $orders[0]->getPayload());
    }

    public function testGetCompanyWithSubscriptions(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCompanyResponseWithSubscriptions.php',
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->getCompany('00000000-0000-0000-0000-000000000000', false, true);
        self::assertEquals(CompanyType::AGENCY, $response->getCompanyType());
        self::assertEquals('Test Company', $response->getTitle());
        self::assertEquals('test-company', $response->getSlug());
        $subscriptions = $response->getSubscriptions();
        self::assertCount(3, $subscriptions);
        self::assertEquals('GOLD', $response->getMembership()->getSubscriptionSubType());

        self::assertSame('00000000-0000-0000-0000-000000000000', $subscriptions[0]->getUuid());
        self::assertSame('sub_AAAAAAAAA', $subscriptions[0]->getSubscriptionIdentifier());
        self::assertSame(SubscriptionType::PSL, $subscriptions[0]->getSubscriptionType());
        self::assertSame(PSLType::MAP_VIEW, $subscriptions[0]->getSubscriptionSubType());
        self::assertSame(SubscriptionStatus::ACTIVE, $subscriptions[0]->getSubscriptionStatus());
        self::assertSame(['items' => [['foo' => 'bar']]], $subscriptions[0]->getPayload());

        self::assertSame('11111111-1111-1111-1111-111111111111', $subscriptions[1]->getUuid());
        self::assertSame('sub_BBBBBBBBB', $subscriptions[1]->getSubscriptionIdentifier());
        self::assertSame(SubscriptionType::PSL, $subscriptions[1]->getSubscriptionType());
        self::assertSame(PSLType::PROFILE_BUNDLE, $subscriptions[1]->getSubscriptionSubType());
        self::assertSame(SubscriptionStatus::INCOMPLETE_EXPIRED, $subscriptions[1]->getSubscriptionStatus());
        self::assertSame(['items' => [['foo' => 'bar']]], $subscriptions[1]->getPayload());
    }

    public function testGetSearchCompanies(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetSearchCompanyResponse.php',
        ]);
        $searchDemand = (new OrganizationSearchDemand())->setTerm('Test Company');
        $response = (new CompanyApi($this->getClient($handler)))->search($searchDemand);
        self::assertCount(2, $response);
    }

    public function testCreateCompany(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCompanyResponse.php',
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->createCompany($this->getTestCompany());
        self::assertEquals(CompanyType::AGENCY, $response->getCompanyType());
        self::assertEquals('Test Company', $response->getTitle());
        self::assertEquals('test-company', $response->getSlug());
    }

    public function testUpdateCompany(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCompanyResponse.php',
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->updateCompany('00000000-0000-0000-0000-000000000000', $this->getTestCompany());
        self::assertEquals('Test Company', $response->getTitle());
        self::assertEquals('test-company', $response->getSlug());
        self::assertCount(4, $response->getEmployees());
        self::assertCount(2, $response->getAddresses());
    }

    public function testInviteEmployee(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCompanyInviteResponse.php',
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->inviteEmployee('00000000-0000-0000-0000-000000000000', 'oelie-boelie', 'EMPLOYEE');
        self::assertEquals('oelie-boelie', $response->getUsername());
        self::assertEquals('oelie@boelie.nl', $response->getEmail());
        self::assertEquals('abcd', $response->getInviteCode());
    }

    public function testConfirmEmployee(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetConfirmCompanyInviteResponse.php',
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->confirmEmployeeInvitation('00000000-0000-0000-0000-000000000000');
        self::assertEquals('oelie-boelie', $response->getUser()->getUsername());
        self::assertEquals('oelie@boelie.nl', $response->getUser()->getPrimaryEmail());
        self::assertEquals('EMPLOYEE', $response->getRole());
    }

    public function testUpdateEmployee(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetEmployeeResponse.php',
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->updateEmployee('00000000-0000-0000-0000-000000000000', 'MANAGER');
        self::assertEquals('oelie-boelie', $response->getUser()->getUsername());
        self::assertEquals('oelie@boelie.nl', $response->getUser()->getPrimaryEmail());
        self::assertEquals('MANAGER', $response->getRole());
    }

    public function testGetInvitations(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCompanyInvitationsReponse.php',
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->getOpenInvitations('00000000-0000-0000-0000-000000000000');
        self::assertCount(1, $response);
    }

    public function testDeleteCompany(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php',
        ]);
        $api = new CompanyApi($this->getClient($handler));
        try {
            $api->deleteCompany('00000000-0000-0000-0000-000000000000');
            $anExceptionWasThrown = false;
        } catch (\Exception) {
            $anExceptionWasThrown = true;
        }
        self::assertFalse($anExceptionWasThrown);
    }

    public function testRevokeEmployeeInvitation(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php',
        ]);
        $api = new CompanyApi($this->getClient($handler));
        try {
            $api->revokeEmployeeInvitation('00000000-0000-0000-0000-000000000000', '00000000-0000-0000-0000-000000000000');
            $anExceptionWasThrown = false;
        } catch (\Exception) {
            $anExceptionWasThrown = true;
        }
        self::assertFalse($anExceptionWasThrown);
    }

    public function testDeleteEmployee(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php',
        ]);
        $api = new CompanyApi($this->getClient($handler));
        try {
            $api->deleteEmployee('00000000-0000-0000-0000-000000000000');
            $anExceptionWasThrown = false;
        } catch (\Exception $e) {
            $anExceptionWasThrown = true;
        }
        self::assertFalse($anExceptionWasThrown);
    }

    public function testMergeCompanies(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/CompaniesMergeResponse.php',
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $mergeCompanyDto = (new MergeCompanyAssembler())
            ->create([
                'title' => 'a0000000-0000-0000-0000-000000000000',
                'slug' => 'a0000000-0000-0000-0000-000000000000',
                'companyType' => 'a0000000-0000-0000-0000-000000000000',
                'vatId' => 'a0000000-0000-0000-0000-000000000000',
                'domain' => 'a0000000-0000-0000-0000-000000000000',
            ])->getDto();
        $response = $api->merge('a0000000-0000-0000-0000-000000000000', 'b0000000-0000-0000-0000-000000000001', $mergeCompanyDto);
        self::assertSame('a0000000-0000-0000-0000-000000000000', $response['source']);
        self::assertSame('b0000000-0000-0000-0000-000000000000', $response['target']);
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
