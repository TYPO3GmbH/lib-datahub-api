<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use DateTime;
use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\UserApi;
use T3G\DatahubApiLibrary\Entity\Certification;
use T3G\DatahubApiLibrary\Entity\User;
use T3G\DatahubApiLibrary\Enum\CertificationVersion;
use T3G\DatahubApiLibrary\Enum\CompanyType;
use T3G\DatahubApiLibrary\Enum\MembershipType;
use T3G\DatahubApiLibrary\Enum\SubscriptionStatus;
use T3G\DatahubApiLibrary\Enum\SubscriptionType;

class UserApiTest extends AbstractApiTest
{
    public function testGetUser(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserResponse.php'
        ]);
        $api = new UserApi($this->getClient($handler));
        $response = $api->getUser('oelie-boelie');
        $this->assertEquals('oelie-boelie', $response->getUsername());
        $this->assertCount(2, $response->getAddresses());
        $this->assertCount(2, $response->getPostalAddresses());
        $this->assertCount(2, $response->getLinks());
        $this->assertCount(1, $response->getCertifications());
        $this->assertEquals('ACADEMIC_BRONZE', $response->getMembership()->getSubscriptionSubType());
    }

    public function testGetUserWithOrders(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserResponseWithOrders.php'
        ]);
        $response = (new UserApi($this->getClient($handler)))
            ->getUser('oelie-boelie', true);
        $this->assertEquals('oelie-boelie', $response->getUsername());
        $orders = $response->getOrders();
        $this->assertCount(1, $orders);
        $this->assertSame('A12345', $orders[0]->getOrderNumber());
        $this->assertSame(['items' => [['foo' => 'bar']]], $orders[0]->getPayload());
        $this->assertEquals('ACADEMIC_BRONZE', $response->getMembership()->getSubscriptionSubType());
    }

    public function testGetUserWithSubscriptions(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserResponseWithSubscriptions.php'
        ]);
        $response = (new UserApi($this->getClient($handler)))
            ->getUser('oelie-boelie', false, true);
        $this->assertEquals('oelie-boelie', $response->getUsername());

        $subscriptions = $response->getSubscriptions();
        $this->assertCount(1, $subscriptions);
        $this->assertEquals('ACADEMIC_BRONZE', $response->getMembership()->getSubscriptionSubType());
        $this->assertSame('00000000-0000-0000-0000-000000000000', $subscriptions[0]->getUuid());
        $this->assertSame('sub_AAAAAAAAA', $subscriptions[0]->getSubscriptionIdentifier());
        $this->assertSame(SubscriptionType::MEMBERSHIP, $subscriptions[0]->getSubscriptionType());
        $this->assertSame(MembershipType::ACADEMIC_BRONZE, $subscriptions[0]->getSubscriptionSubType());
        $this->assertSame(SubscriptionStatus::ACTIVE, $subscriptions[0]->getSubscriptionStatus());
        $this->assertSame(['items' => [['foo' => 'bar']]], $subscriptions[0]->getPayload());
    }

    public function testGetSearchUsers(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetSearchUserResponse.php'
        ]);
        $response = (new UserApi($this->getClient($handler)))
            ->search('oelie-boelie');
        $this->assertEquals(2, count($response));
    }

    public function testGetProfile(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetProfileResponse.php'
        ]);
        $api = new UserApi($this->getClient($handler));
        $response = $api->getProfile('oelie-boelie');
        $this->assertEquals('oelie-boelie', $response->getUsername());
        $this->assertEquals('Oelie', $response->getFirstName());
        $this->assertEquals('Boelie', $response->getLastName());
        $this->assertEquals('oelie@boelie.nl', $response->getPrimaryEmail());
        $this->assertEquals(null, $response->getPhone());
    }

    public function testUpdateUser(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserResponse.php'
        ]);
        $api = new UserApi($this->getClient($handler));
        $response = $api->updateUser('oelie-boelie', $this->getTestUser());
        $this->assertEquals('oelie-boelie', $response->getUsername());
        $this->assertCount(2, $response->getAddresses());
        $this->assertCount(2, $response->getLinks());
        $this->assertCount(1, $response->getCertifications());
        $this->assertEquals('ACADEMIC_BRONZE', $response->getMembership()->getSubscriptionSubType());
    }

    public function testGetCompanyHistory(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserCompaniesResponse.php'
        ]);
        $api = new UserApi($this->getClient($handler));
        $response = $api->getCompanyHistory('oelie-boelie');
        $this->assertCount(1, $response);
        $this->assertEquals(CompanyType::UNIVERSITY, $response[0]->getCompany()->getCompanyType());
        $this->assertEquals('Dien Mam International', $response[0]->getCompany()->getTitle());
    }

    public function testGetCompanies(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserCompaniesResponse.php'
        ]);
        $api = new UserApi($this->getClient($handler));
        $response = $api->getCompanies('oelie-boelie');
        $this->assertCount(1, $response);
        $this->assertEquals('Dien Mam International', $response[0]->getCompany()->getTitle());
    }

    public function getTestUser(): User
    {
        return (new User())
            ->setUsername('oelie-boelie')
            ->setFirstName('Oelie')
            ->setLastName('Boelie')
            ->setEmail('oelie@boelie.nl')
            ->setPhone(null);
    }

    public function testCreateCertification(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/PostCertificationResponse.php'
        ]);

        $certification = (new Certification())
            ->setType('TCCE')
            ->setVersion(CertificationVersion::TEN)
            ->setAddress(implode("\r\n", ['Oelie Boelie', 'Geerke 8', '5271 XT Maaskantje']))
            ->setExamUrl('https://exam.typo3.com/exam/00000000-0000-0000-0000-000000000000')
            ->setExamAccessCode('00000000-0000-0000-0000-000000000000')
            ->setExamProctoringInstructions('Vote for Zoidberg!')
            ->setExamStartDate(new DateTime('2020-06-02T00:00:00+00:00'))
            ->setExamEndDate(new DateTime('2022-06-02T00:00:00+00:00'))
            ->setExamDuration(90)
        ;

        $api = new UserApi($this->getClient($handler));
        $response = $api->createCertification('oelie-boelie', $certification);
        $this->assertEquals('TCCE', $response->getType());
        $this->assertEquals('2020-06-02T00:00:00+00:00', $response->getExamDate()->format(DateTime::ATOM));
        $this->assertEquals('online', $response->getExamLocation());
        $this->assertEquals('UNKNOWN', $response->getStatus());
    }

    public function testUpdateCertification(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/PostCertificationResponse.php'
        ]);

        $certification = (new Certification())
            ->setType('TCCE')
            ->setVersion(CertificationVersion::TEN)
            ->setAddress(implode("\r\n", ['Oelie Boelie', 'Geerke 8', '5271 XT Maaskantje']))
            ->setExamUrl('https://exam.typo3.com/exam/00000000-0000-0000-0000-000000000000')
            ->setExamAccessCode('00000000-0000-0000-0000-000000000000')
            ->setExamProctoringInstructions('Vote for Zoidberg!')
            ->setExamStartDate(new DateTime('2020-06-02T00:00:00+00:00'))
            ->setExamEndDate(new DateTime('2022-06-02T00:00:00+00:00'))
            ->setExamDuration(90)
        ;

        $api = new UserApi($this->getClient($handler));
        $response = $api->updateCertification('oelie-boelie', '00000000-0000-0000-0000-000000000000', $certification);
        $this->assertEquals('TCCE', $response->getType());
        $this->assertEquals('2020-06-02T00:00:00+00:00', $response->getExamDate()->format(DateTime::ATOM));
        $this->assertEquals('online', $response->getExamLocation());
        $this->assertEquals('UNKNOWN', $response->getStatus());
    }

    public function testGetCertificationList(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCertificationsResponse.php'
        ]);
        $api = new UserApi($this->getClient($handler));
        $certifications = $api->getCertificationList('oelie-boelie');
        $this->assertCount(2, $certifications);
    }
}
