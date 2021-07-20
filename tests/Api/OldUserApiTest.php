<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\OldUserApi;

class OldUserApiTest extends AbstractApiTest
{
    public function testSearch(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/PostSearchOldUsersResponse.php'
        ]);
        $api = new OldUserApi($this->getClient($handler));
        $response = $api->search('neo');
        $this->assertIsArray($response);
        $this->assertCount(3, $response);
        $entity = array_pop($response);
        $this->assertArrayHasKey('username', $entity);
        $this->assertArrayHasKey('email', $entity);
        $this->assertArrayHasKey('deleteDate', $entity);
        $this->assertArrayHasKey('otrsIssue', $entity);
        $this->assertArrayHasKey('comment', $entity);
    }

    public function testGetReservedUser(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetReservedUserResponse.php'
        ]);
        $response = (new OldUserApi($this->getClient($handler)))->getReservedUser('11111111-1111-1111-1111-111111111111');
        self::assertEquals('11111111-1111-1111-1111-111111111111', $response->getUuid());
        self::assertEquals('serious.spam', $response->getUsername());
        self::assertEquals('spammer@spam.org', $response->getEmail());
        self::assertEquals('2020-01-10T00:00:00+00:00', $response->getDeleteDate()->format(\DateTimeInterface::ATOM));
        self::assertEquals('123', $response->getOtrsIssue());
        self::assertEquals('Is a spammer', $response->getComment());
        self::assertEquals('DELETED', $response->getStatus());
    }

    public function testReEnable(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserResponse.php'
        ]);
        $api = new OldUserApi($this->getClient($handler));
        $response = $api->reEnable('oelie-boelie');
        $this->assertEquals('oelie-boelie', $response->getUsername());
        $this->assertSame('oelie.boelie@typo3.org', $response->getPrimaryEmail());
        $this->assertCount(2, $response->getAddresses());
        $this->assertCount(2, $response->getLinks());
        $this->assertCount(1, $response->getCertifications());
        $this->assertEquals('ACADEMIC_BRONZE', $response->getMembership()->getSubscriptionSubType());
    }

    public function testReEnableWithEmail(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserResponseWithUpdatedEmail.php'
        ]);
        $api = new OldUserApi($this->getClient($handler));
        $response = $api->reEnable('oelie-boelie', 'foo@bar.baz');
        $this->assertEquals('oelie-boelie', $response->getUsername());
        $this->assertSame('foo@bar.baz', $response->getPrimaryEmail());
        $this->assertCount(2, $response->getAddresses());
        $this->assertCount(2, $response->getLinks());
        $this->assertCount(1, $response->getCertifications());
        $this->assertEquals('ACADEMIC_BRONZE', $response->getMembership()->getSubscriptionSubType());
    }
}
