<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\UserApi;
use T3G\DatahubApiLibrary\Entity\Certification;
use T3G\DatahubApiLibrary\Entity\User;
use T3G\DatahubApiLibrary\Enum\CertificationVersion;
use T3G\DatahubApiLibrary\Enum\CompanyType;
use T3G\DatahubApiLibrary\Enum\MembershipType;
use T3G\DatahubApiLibrary\Enum\SubscriptionStatus;
use T3G\DatahubApiLibrary\Enum\SubscriptionType;

class UserApiTest extends AbstractApiTestCase
{
    public function testGetUser(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserResponse.php',
        ]);
        $api = new UserApi($this->getClient($handler));
        $response = $api->getUser('oelie-boelie');
        self::assertEquals('oelie-boelie', $response->getUsername());
        self::assertCount(2, $response->getAddresses());
        self::assertCount(2, $response->getPostalAddresses());
        self::assertCount(2, $response->getLinks());
        self::assertCount(1, $response->getCertifications());
        self::assertEquals('ACADEMIC_BRONZE', $response->getMembership()->getSubscriptionSubType());
    }

    public function testGetUserWithOrders(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserResponseWithOrders.php',
        ]);
        $response = (new UserApi($this->getClient($handler)))
            ->getUser('oelie-boelie', true);
        self::assertEquals('oelie-boelie', $response->getUsername());
        $orders = $response->getOrders();
        self::assertCount(1, $orders);
        self::assertSame('A12345', $orders[0]->getOrderNumber());
        self::assertSame(['items' => [['foo' => 'bar']]], $orders[0]->getPayload());
        self::assertEquals('ACADEMIC_BRONZE', $response->getMembership()->getSubscriptionSubType());
    }

    public function testGetUserWithSubscriptions(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserResponseWithSubscriptions.php',
        ]);
        $response = (new UserApi($this->getClient($handler)))
            ->getUser('oelie-boelie', false, true);
        self::assertEquals('oelie-boelie', $response->getUsername());

        $subscriptions = $response->getSubscriptions();
        self::assertCount(1, $subscriptions);
        self::assertEquals('ACADEMIC_BRONZE', $response->getMembership()->getSubscriptionSubType());
        self::assertSame('00000000-0000-0000-0000-000000000000', $subscriptions[0]->getUuid());
        self::assertSame('sub_AAAAAAAAA', $subscriptions[0]->getSubscriptionIdentifier());
        self::assertSame(SubscriptionType::MEMBERSHIP, $subscriptions[0]->getSubscriptionType());
        self::assertSame(MembershipType::ACADEMIC_BRONZE, $subscriptions[0]->getSubscriptionSubType());
        self::assertSame(SubscriptionStatus::ACTIVE, $subscriptions[0]->getSubscriptionStatus());
        self::assertSame(['items' => [['foo' => 'bar']]], $subscriptions[0]->getPayload());
    }

    public function testGetSearchUsers(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetSearchUserResponse.php',
        ]);
        $response = (new UserApi($this->getClient($handler)))
            ->search('oelie-boelie');
        self::assertCount(2, $response);
    }

    public function testGetProfile(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetProfileResponse.php',
        ]);
        $api = new UserApi($this->getClient($handler));
        $response = $api->getProfile('oelie-boelie');
        self::assertEquals('oelie-boelie', $response->getUsername());
        self::assertEquals('Oelie', $response->getFirstName());
        self::assertEquals('Boelie', $response->getLastName());
        self::assertEquals('oelie@boelie.nl', $response->getPrimaryEmail());
        self::assertNull($response->getPhone());
    }

    public function testUpdateUser(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserResponse.php',
        ]);
        $api = new UserApi($this->getClient($handler));
        $response = $api->updateUser('oelie-boelie', $this->getTestUser());
        self::assertEquals('oelie-boelie', $response->getUsername());
        self::assertCount(2, $response->getAddresses());
        self::assertCount(2, $response->getLinks());
        self::assertCount(1, $response->getCertifications());
        self::assertEquals('ACADEMIC_BRONZE', $response->getMembership()->getSubscriptionSubType());
    }

    public function testGetCompanyHistory(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserCompaniesResponse.php',
        ]);
        $api = new UserApi($this->getClient($handler));
        $response = $api->getCompanyHistory('oelie-boelie');
        self::assertCount(1, $response);
        self::assertEquals(CompanyType::UNIVERSITY, $response[0]->getCompany()->getCompanyType());
        self::assertEquals('Dien Mam International', $response[0]->getCompany()->getTitle());
    }

    public function testGetCompanies(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserCompaniesResponse.php',
        ]);
        $api = new UserApi($this->getClient($handler));
        $response = $api->getCompanies('oelie-boelie');
        self::assertCount(1, $response);
        self::assertEquals('Dien Mam International', $response[0]->getCompany()->getTitle());
    }

    public function getTestUser(): User
    {
        return (new User())
            ->setUsername('oelie-boelie')
            ->setFirstName('Oelie')
            ->setLastName('Boelie')
            ->setPhone(null);
    }

    public function testCreateCertification(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/PostCertificationResponse.php',
        ]);

        $certification = (new Certification())
            ->setType('TCCE')
            ->setVersion(CertificationVersion::TEN)
            ->setAddress(implode("\r\n", ['Oelie Boelie', 'Geerke 8', '5271 XT Maaskantje']))
            ->setExamUrl('https://exam.typo3.com/exam/00000000-0000-0000-0000-000000000000')
            ->setExamAccessCode('00000000-0000-0000-0000-000000000000')
            ->setExamProctoringInstructions('Vote for Zoidberg!')
            ->setExamStartDate(new \DateTime('2020-06-02T00:00:00+00:00'))
            ->setExamEndDate(new \DateTime('2022-06-02T00:00:00+00:00'))
            ->setExamDuration(90)
        ;

        $api = new UserApi($this->getClient($handler));
        $response = $api->createCertification('oelie-boelie', $certification);
        self::assertEquals('TCCE', $response->getType());
        self::assertEquals('2020-06-02T00:00:00+00:00', $response->getExamDate()->format(\DateTimeInterface::ATOM));
        self::assertEquals('online', $response->getExamLocation());
        self::assertEquals('UNKNOWN', $response->getStatus());
    }

    public function testUpdateCertification(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/PostCertificationResponse.php',
        ]);

        $certification = (new Certification())
            ->setType('TCCE')
            ->setVersion(CertificationVersion::TEN)
            ->setAddress(implode("\r\n", ['Oelie Boelie', 'Geerke 8', '5271 XT Maaskantje']))
            ->setExamUrl('https://exam.typo3.com/exam/00000000-0000-0000-0000-000000000000')
            ->setExamAccessCode('00000000-0000-0000-0000-000000000000')
            ->setExamProctoringInstructions('Vote for Zoidberg!')
            ->setExamStartDate(new \DateTime('2020-06-02T00:00:00+00:00'))
            ->setExamEndDate(new \DateTime('2022-06-02T00:00:00+00:00'))
            ->setExamDuration(90)
        ;

        $api = new UserApi($this->getClient($handler));
        $response = $api->updateCertification('oelie-boelie', '00000000-0000-0000-0000-000000000000', $certification);
        self::assertEquals('TCCE', $response->getType());
        self::assertEquals('2020-06-02T00:00:00+00:00', $response->getExamDate()->format(\DateTimeInterface::ATOM));
        self::assertEquals('online', $response->getExamLocation());
        self::assertEquals('UNKNOWN', $response->getStatus());
    }

    public function testGetCertificationList(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCertificationsResponse.php',
        ]);
        $api = new UserApi($this->getClient($handler));
        $certifications = $api->getCertificationList('oelie-boelie');
        self::assertCount(2, $certifications);
    }

    public function testCreateUser(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserResponse.php',
        ]);
        $api = new UserApi($this->getClient($handler));
        $response = $api->createUser($this->getTestUser());
        self::assertEquals('oelie-boelie', $response->getUsername());
        self::assertCount(2, $response->getAddresses());
        self::assertCount(2, $response->getPostalAddresses());
        self::assertCount(2, $response->getLinks());
        self::assertCount(1, $response->getCertifications());
        self::assertEquals('ACADEMIC_BRONZE', $response->getMembership()->getSubscriptionSubType());
    }
}
